import streamlit as st
import numpy as np
import joblib

# Load model and scaler
model = joblib.load("multi_model.pkl")
scaler = joblib.load("multi_scaler.pkl")

# Prediction label map
label_map = {
    0: "No disease",
    1: "Mild Heart Disease",
    2: "Moderate Heart Disease",
    3: "Severe Heart Disease",
    4: "Critical Heart Condition"
}

st.set_page_config(page_title="Heart Disease Severity Predictor", page_icon="💓")
st.title("🫀 Heart Disease Severity Prediction")
st.markdown("Enter patient details to predict the severity level of heart disease (0–4).")

with st.form("prediction_form"):
    st.markdown("### 🔍 Patient Information")

    age = st.slider("Age", 20, 100, 55, help="Age in years")
    sex = st.radio("Sex", ["Male", "Female"], help="1 = Male, 0 = Female")
    cp = st.selectbox("Chest Pain Type (cp)", [0, 1, 2, 3], help="0: Typical angina, 1: Atypical angina, 2: Non-anginal pain, 3: Asymptomatic")
    trestbps = st.number_input("Resting Blood Pressure (mm Hg)", 80, 200, 120, help="Resting blood pressure measured in mm Hg")
    chol = st.number_input("Cholesterol (mg/dL)", 100, 400, 200, help="Serum cholesterol in mg/dL")
    fbs = st.radio("Fasting Blood Sugar > 120 mg/dL?", ["Yes", "No"], help="1 = True, 0 = False")
    restecg = st.selectbox("Resting ECG", [0, 1, 2], help="Electrocardiographic results: 0 = Normal, 1 = Abnormal, 2 = Probable or definite hypertrophy")
    thalach = st.slider("Max Heart Rate Achieved", 70, 210, 150, help="Maximum heart rate achieved during test")
    exang = st.radio("Exercise-induced Angina", ["Yes", "No"], help="1 = Yes, 0 = No")
    oldpeak = st.slider("ST Depression (oldpeak)", 0.0, 6.0, 1.0, help="ST depression induced by exercise relative to rest")
    slope = st.selectbox("Slope of ST segment", [0, 1, 2], help="0 = Upsloping, 1 = Flat, 2 = Downsloping")
    ca = st.selectbox("Major Vessels Colored (0–3)", [0, 1, 2, 3], help="Number of major vessels (0–3) colored by fluoroscopy")
    thal = st.selectbox("Thalassemia", [1.0, 2.0, 3.0], help="1 = Normal, 2 = Fixed defect, 3 = Reversible defect")

    submitted = st.form_submit_button("🧠 Predict")

if submitted:
    # Format the input
    input_data = np.array([[
        age,
        1 if sex == "Male" else 0,
        cp,
        trestbps,
        chol,
        1 if fbs == "Yes" else 0,
        restecg,
        thalach,
        1 if exang == "Yes" else 0,
        oldpeak,
        slope,
        ca,
        thal
    ]])

    # Scale and predict
    input_scaled = scaler.transform(input_data)
    prediction = model.predict(input_scaled)[0]

    # Display result
    st.markdown("### 🧬 Result")
    st.success(f"🩺 Predicted Severity Level: **{prediction} — {label_map[prediction]}**")

    import matplotlib.pyplot as plt
    import seaborn as sns
    import pandas as pd

    # Feature importance chart
    st.markdown("### 🔍 Feature Importances")

    features = [
        "age", "sex", "cp", "trestbps", "chol", "fbs", "restecg",
        "thalach", "exang", "oldpeak", "slope", "ca", "thal"
    ]

    importances = model.feature_importances_
    df_imp = pd.DataFrame({"Feature": features, "Importance": importances})
    df_imp = df_imp.sort_values(by="Importance", ascending=False)

    plt.figure(figsize=(8, 5))
    sns.barplot(x="Importance", y="Feature", data=df_imp, palette="Blues_d")
    st.pyplot(plt)

    # Show prediction probabilities
    st.markdown("### 🎯 Class Prediction Probabilities")

    probabilities = model.predict_proba(input_scaled)[0]
    labels = list(model.classes_)

    df_prob = pd.DataFrame({
        "Class": labels,
        "Probability": probabilities
    })

    plt.figure(figsize=(6, 4))
    sns.barplot(x="Class", y="Probability", data=df_prob, palette="Set2")
    st.pyplot(plt)

    # Optional: Advice
    if prediction >= 3:
        st.error("⚠️ Urgent medical attention is recommended.")
    elif prediction >= 1:
        st.warning("⚠️ Follow-up with a cardiologist is advised.")
    else:
        st.balloons()
        st.info("🎉 No signs of heart disease detected.")
