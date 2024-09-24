const express = require('express');
const nodemailer = require('nodemailer');
const bodyParser = require('body-parser');
const cors = require('cors');

const app = express();
const PORT = process.env.PORT || 5000;

// Middleware
app.use(cors());
app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());

// Set up Nodemailer transporter
const transporter = nodemailer.createTransport({
  service: 'gmail', // Replace with your email service
  auth: {
    user: 'techedmy@gmail.com', // Your email address
    pass: 'Tech@2024', // Your email password (use App Passwords for Gmail)
  },
});

// Define the POST route for form submission
app.post('/api/contact', (req, res) => {
  const { user_name, user_email, user_contact, user_message } = req.body;

  // Set up email data
  const mailOptions = {
    from: user_email, // Sender address
    to: 'techedmy@gmail.com', // List of recipients
    subject: 'New Contact Form Submission',
    text: `
      You have a new contact form submission:

      Name: ${user_name}
      Email: ${user_email}
      Contact Number: ${user_contact}
      Message: ${user_message}
    `,
  };

  // Send the email
  transporter.sendMail(mailOptions, (error, info) => {
    if (error) {
      console.error('Error sending email:', error);
      return res.status(500).send('Error sending email');
    }
    console.log('Email sent:', info.response);
    res.status(200).send('Message sent successfully');
  });
});

// Start the server

app.listen(PORT, () => {
  console.log(`Server is running on http://localhost:${PORT}`);
});
