# 📧 PHP Mailer - Email Sending System

This project allows users to send emails via **SMTP server** using **PHP** and the **PHPMailer** library. It features a clean **Bootstrap** UI and uses **SweetAlert2** for better user experience.

![Banner](banner.png)

## 📌 Features
✔ **Send emails via SMTP** 📧  
✔ **CSRF protection for security** 🔐  
✔ **SweetAlert2 for user notifications** 💡  
✔ **Responsive UI with Bootstrap** 🎨  
✔ **AJAX support for seamless requests** ⚡  

---

## 📂 Project Structure
```
/project-root
│── /src/images/logo.svg      # Project logo
│── /vendor                   # Composer dependencies
│── index.php                 # Frontend
│── send-mail.php             # Backend logic for sending emails
│── composer.json             # Composer configuration
│── README.md                 # Documentation
```

## 🎯 Workflow Overview
1️⃣ **User** fills out the email form and submits.  
2️⃣ **JavaScript fetch API** sends data to `send-mail.php`.  
3️⃣ **PHP backend** validates data, checks CSRF token, and sends an email using PHPMailer.  
4️⃣ **SweetAlert2** displays a success/failure notification.  

## 🚀 Setup & Installation

1️⃣ Clone the repository:
```bash
git clone https://github.com/Iqbolshoh/php-send-mail.git
```

2️⃣ Navigate to the project directory:
```bash
cd php-mailer
```

3️⃣ Install dependencies via Composer:
```bash
composer install
```

4️⃣ Configure your SMTP settings in `send-mail.php`:
```php
// SMTP Server Configuration
define('SMTP_HOST', 'mail.yourdomain.com');
define('SMTP_USER', 'your-email@yourdomain.com');
define('SMTP_PASS', 'your-email-password');
define('SMTP_PORT', 465); // 465 for SSL, 587 for TLS
```

5️⃣ Run the project on a local server:
```bash
php -S localhost:8000
```

6️⃣ Open your browser and go to:
```
http://localhost:8000/
```
---

## Technologies Used

<div style="display: flex; flex-wrap: wrap; gap: 5px;">
    <img src="https://img.shields.io/badge/HTML-%23F06529.svg?style=for-the-badge&logo=html5&logoColor=white" alt="HTML">
    <img src="https://img.shields.io/badge/Bootstrap-%237952B3.svg?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap">
    <img src="https://img.shields.io/badge/JavaScript-%23323330.svg?style=for-the-badge&logo=javascript&logoColor=%23F7DF1E" alt="JavaScript">
    <img src="https://img.shields.io/badge/PHP-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
</div>

## Contributing

Contributions are welcome! If you have suggestions or want to enhance the project, feel free to fork the repository and submit a pull request.


## Connect with Me

I love connecting with new people and exploring new opportunities. Feel free to reach out to me through any of the platforms below:

<table>
    <tr>
        <td>
            <a href="https://github.com/iqbolshoh">
                <img src="https://raw.githubusercontent.com/rahuldkjain/github-profile-readme-generator/master/src/images/icons/Social/github.svg"
                    height="48" width="48" alt="GitHub" />
            </a>
        </td>
        <td>
            <a href="https://t.me/iqbolshoh_777">
                <img src="https://github.com/gayanvoice/github-active-users-monitor/blob/master/public/images/icons/telegram.svg"
                    height="48" width="48" alt="Telegram" />
            </a>
        </td>
        <td>
            <a href="https://www.linkedin.com/in/iiqbolshoh/">
                <img src="https://github.com/gayanvoice/github-active-users-monitor/blob/master/public/images/icons/linkedin.svg"
                    height="48" width="48" alt="LinkedIn" />
            </a>
        </td>
        <td>
            <a href="https://instagram.com/iqbolshoh_777" target="blank"><img align="center"
                    src="https://raw.githubusercontent.com/rahuldkjain/github-profile-readme-generator/master/src/images/icons/Social/instagram.svg"
                    alt="instagram" height="48" width="48" /></a>
        </td>
        <td>
            <a href="https://wa.me/qr/22PVFQSMQQX4F1">
                <img src="https://github.com/gayanvoice/github-active-users-monitor/blob/master/public/images/icons/whatsapp.svg"
                    height="48" width="48" alt="WhatsApp" />
            </a>
        </td>
        <td>
            <a href="https://x.com/iqbolshoh_777">
                <img src="https://img.shields.io/badge/X-000000?style=for-the-badge&logo=x&logoColor=white" height="48"
                    width="48" alt="Twitter" />
            </a>
        </td>
        <td>
            <a href="mailto:iilhomjonov777@gmail.com">
                <img src="https://github.com/gayanvoice/github-active-users-monitor/blob/master/public/images/icons/gmail.svg"
                    height="48" width="48" alt="Email" />
            </a>
        </td>
    </tr>
</table>
