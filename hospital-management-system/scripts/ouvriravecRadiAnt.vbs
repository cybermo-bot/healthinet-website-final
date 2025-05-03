Dim objShell, objFSO
Set objShell = CreateObject("WScript.Shell")
Set objFSO = CreateObject("Scripting.FileSystemObject")

Dim dicomFile
dicomFile = WScript.Arguments.Item(0)

If objFSO.FileExists(dicomFile) Then
    objShell.Run """C:\Program Files\RadiAntViewer64bit\RadiAntViewer.exe"" """ & dicomFile & """", 1, False
Else
    MsgBox "Le fichier DICOM n'a pas été trouvé."
End If

Set objShell = Nothing
Set objFSO = Nothing
