import streamlit as st
import speech_recognition as sr
import re
from email.message import EmailMessage
import smtplib

# Function to convert audio to text
def convert_audio_to_text(audio_file):
    recognizer = sr.Recognizer()
    with sr.AudioFile(audio_file) as source:
        audio_data = recognizer.record(source)
        text = recognizer.recognize_google(audio_data)
    return text

# Function to extract keywords and prepare prescription
# Function to extract keywords and prepare prescription
def prepare_prescription(text):
    # Extract keywords (e.g., medicine names and timings) using regex or NLP techniques
    medicine_info = re.findall(r'tablet (\w+ \d+ mg) (\d+ days) after food morning only|syrup (\w+) (\d+ ml) (\d+ days) before food night', text)
    
    # Prepare prescription format
    prescription = "Prescription:\n"
    if len(medicine_info) > 0:
        for info in medicine_info:
            if info[0]:  # If tablet information is found
                prescription += f"- {info[0]}: {info[1]} times a day\n"
            elif info[2]:  # If syrup information is found
                prescription += f"- {info[2]}: {info[3]} ml, {info[4]} times a day\n"
    else:
        prescription += "No medication information found.\n"

    return prescription

# Function to send prescription to patient's email
def send_prescription_to_email(prescription, receiver_email):
    # Update with your Gmail SMTP credentials and application-specific password
    sender_email = "bodemvinay@gmail.com"  
    sender_password = "brjw udhq sced uwbf"  # Update with your application-specific password

    msg = EmailMessage()
    msg["Subject"] = "Your Prescription"
    msg["From"] = sender_email  # Update with your Gmail address
    msg["To"] = receiver_email
    msg.set_content(prescription)

    with smtplib.SMTP_SSL("smtp.gmail.com", 465) as server:
        server.login(sender_email, sender_password)
        server.send_message(msg)

    # Indicate success
    st.success("Prescription sent successfully!")


    # Indicate success
    st.success("Prescription sent successfully!")

# Streamlit app
def main():
    st.title("Voice Prescription App")

    # File uploader for audio file
    audio_file = st.file_uploader("Upload Audio File", type=["mp3", "wav"])

    if audio_file:
        st.audio(audio_file, format="audio/wav")

        # Convert audio to text
        text = convert_audio_to_text(audio_file)

        # Display converted text
        st.subheader("Converted Text:")
        st.write(text)

        # Extract keywords and prepare prescription
        prescription = prepare_prescription(text)

        # Display prescription for verification and correction
        st.subheader("Prescription:")
        st.write(prescription)

        # Input for patient's email
        receiver_email = st.text_input("Enter Patient's Email")

        # Button to send prescription
        if st.button("Send Prescription"):
            if receiver_email:
                send_prescription_to_email(prescription, receiver_email)
                st.success("Prescription sent successfully!")
            else:
                st.error("Please enter the patient's email.")

if __name__ == "__main__":
    main()
