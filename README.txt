HEALTHINET FINAL PROJECT

-put this in full screen sir Sabri for better visibility-

Project Type: Full Stack Web & AI Healthcare Platform  
Authors: Mohamed Fatnassi - Rached Hammami -- CI-GBM-TTIS-1  
Date: 3/5/2025

=======================
PROJECT DESCRIPTION
======================
HealthiNet is an intelligent healthcare platform designed to guide users through early health assessment, symptom analysis, and direct access to appropriate care. It combines AI-based diagnostics, patient triage, specialist recommendations, and DICOM file management — all in one solution.

The project consists of THREE modules:

1. HealthiNet Website (main frontend)  
2. AI-Powered Chatbot (Flask backend using Mistral via Ollama)  
3. Hospital Patient Management System (PHP-based)

=======================
OBJECTIVES
======================
- Allow users to input symptoms and receive intelligent analysis.
- Dynamically recommend the appropriate specialist.
- Let users select pain location via an interactive human body map.
- Link to a hospital system for managing real patient records.
- Enable upload and preview of medical DICOM imagery.

=======================
TECHNOLOGIES USED
======================
Frontend (Next.js - port 3000):
- Next.js (React framework)
- Tailwind CSS
- SVG pain map
- Hero, About, and Service sections

Backend Chatbot (Flask - port 5000):
- Flask (Python)
- Ollama + locally hosted Mistral model
- JSON memory state
- Follow-up question generation

Heart Disease Predictor (Streamlit - port 8501):
- Python (Pandas, Sklearn)
- Trained ML model for heart condition risk

Hospital System (PHP - port 80):
- PHP + MySQL
- Patient CRUD, login/register, DICOM handling
- Follows HL7-inspired structure
- Tailwind for consistent UI

=======================
REQUIREMENTS => important !
=======================

1. *Ollama*
   - Install from: https://ollama.com
   - Run: `ollama run mistral` (loads and serves Mistral locally)

2. **Python Libraries**
   - Install Python 3.10+
   - Install dependencies (in `/bot/requirements.txt`)
     ```
     pip install -r requirements.txt
     ```

3. *Node.js + NPM*
   - Install from https://nodejs.org
   - For frontend:
     ```
     npm install
     npm run dev
     ```

4. *Streamlit*
   - Run ML heart diagnosis:
     ```
     pip install streamlit pandas scikit-learn
     streamlit run app.py
     ```

5. *XAMPP or WAMP*
   - To run PHP hospital system:
     - Place project in `htdocs` or `www`
     - Start Apache and MySQL
     - Import `hospital_project/database.sql` to create the DB
     - Access via http://localhost/hospital_project

=======================
HOW TO RUN => most important !!
======================

1. Start the chatbot server:
   > cd bot  
   > ollama run mistral (make sure Ollama is installed)  
   > python app.py (runs on localhost:5000)

2. Start the frontend:
   > npm install  
   > npm run dev  
   (Access at http://localhost:3000)
Or access the deployed version here:
   https://healthinet-website.vercel.app               (BETTER)

3. Run the heart disease predictor:
   > streamlit run app.py  
   (Access at http://localhost:8501)

4. Run the hospital system:
   - Place in XAMPP htdocs folder  
   - Start Apache and MySQL  
   -go to fiche_patient.sql file in the fiche_patient folder and copy the code in it the past to create the database related to this section 
   - Access via http://localhost/fiche%20patient/index.php


=======================
FUTURE IMPROVEMENTS
======================
- Doctor map: suggest nearest doctor by specialty  
- Smartwatch integration: sync wearable health data  
- Agentic AI upgrade: multi-step reasoning & decisions  

