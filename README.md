# Collecting-of-real-emails
A simple system allows user to collect any real email address regardless of its domain, and tests it for validation to store it in the database.



Setting before using:
1. Inside "config.php" file, please fill your email address and its password, from which the system sends automatically a validation code to email entered for validation.

2. Inside your database, execute the code found inside "DB SQL.sql" to create the table of saved emails.

3. Inside file "connect_to_database.php" fill your databse connection info.

4. Put homepage as private use for you and validation page as public use for others.



Guidance of using:
1. In textbox found on homepage, enter an email you want to save it in your database, then press "Submit email".

2. At moment of email submitting, the system sent a validation code to ensure that this email is real, once email's owner get this code, he/she should put it in the textbox found on the validation page.

3. Once validation succeed, the email will be saved in the database automatically.
