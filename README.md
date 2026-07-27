<div align="center">

# PHP with MySQL Lab

---

### B.P. Poddar Institute of Management and Technology (BPPIMT)
### Department of Bachelor of Computer Applications (BCA)
### Semester 5

---

Repository for laboratory exercises and programs of **PHP with MySQL**.

</div>

---

## ⚙️ Native Server Setup (Ubuntu/Debian)

> ⚠️ **Important:** This setup guide is strictly for **Debian-based Linux distributions** (such as Ubuntu, Debian, Linux Mint, MX Linux, etc.). It is **not** intended for Windows or macOS.

Run the following commands in your terminal to set up a native Apache, MariaDB, PHP, and phpMyAdmin stack (instead of XAMPP):

### 1. Install LAMP Stack & phpMyAdmin
```bash
# Update package list
sudo apt update

# Install Apache, MariaDB, and PHP with extensions
sudo apt install apache2 mariadb-server mariadb-client php libapache2-mod-php php-mysql php-curl php-mbstring php-xml php-gd php-zip -y

# Install phpMyAdmin
sudo apt install phpmyadmin -y
```
*(During phpMyAdmin install: choose `apache2` using `Space`, select `Yes` for `dbconfig-common`, and set a password).*

### 2. Configure Database Access
Create a dedicated database user since the default MariaDB `root` user does not allow password logins:
```bash
sudo mysql -u root
```
In the MariaDB console, run:
```sql
CREATE USER 'devuser'@'localhost' IDENTIFIED BY 'password123';
GRANT ALL PRIVILEGES ON *.* TO 'devuser'@'localhost' WITH GRANT OPTION;
FLUSH PRIVILEGES;
EXIT;
```
*(Use `devuser` and `password123` to log into `http://localhost/phpmyadmin`)*

---

## 🛠️ Quick Fixes
* **404 phpMyAdmin:** `sudo a2enconf phpmyadmin && sudo systemctl reload apache2`
* **PHP files downloading:** `sudo apt install libapache2-mod-php -y && sudo systemctl restart apache2`





