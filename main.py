from flask import Flask, render_template, request, redirect, url_for, session
from flask_mysqldb import MySQL
from ast import literal_eval
import MySQLdb.cursors
import re

app = Flask(__name__)

# Change this to your secret key (can be anything, it's for extra protection)
app.secret_key = 'your secret key'

# Enter your database connection details below
app.config['MYSQL_HOST'] = 'localhost'
app.config['MYSQL_USER'] = 'root'
app.config['MYSQL_PASSWORD'] = ''
app.config['MYSQL_DB'] = 'testlogin'

# Intialize MySQL
mysql = MySQL(app)


@app.route('/database-project/home.html', methods=['GET', 'POST'])
def home():
     msg = ''
     return render_template('home.html', msg = msg)

@app.route('/database-project/AboutUs.html')
def about():
     msg = ''
     return render_template('AboutUs.html', msg=msg)

@app.route('/database-project/employee.html')
def emp():
    if 'loggedin' not in session:
        return redirect(url_for('login'))

    msg = ''
    return render_template('employee.html', msg=msg)

@app.route('/database-project/shop.html')
def shop():
    msg = ''
    return render_template('employee.html', msg=msg)

@app.route('/database-project/login.php')
def emp():
    if 'loggedin' not in session:
        return redirect(url_for('login'))

    msg = ''
    return render_template('login.php', msg=msg)

@app.route('/database-project/login.html', methods=['GET', 'POST'])
def login():
    # Output message if something goes wrong...
    msg = ''
    # Check if "username" and "password" POST requests exist (user submitted form)
    if request.method == 'POST' and 'username' in request.form and 'password' in request.form:
        # Create variables for easy access
        username = request.form['username']
        password = request.form['password']
        # Check if account exists using MySQL
        cursor = mysql.connection.cursor(MySQLdb.cursors.DictCursor)
        cursor.execute('SELECT * FROM User WHERE username = %s AND password = %s', (username, password,))
        # Fetch one record and return result
        User = cursor.fetchone()
        # If account exists in accounts table in out database
        if User:
            # Create session data, we can access this data in other routes
            session['loggedin'] = True
            #session['id'] = User['id']
            session['username'] = User['username']
            # Redirect to home page
            return redirect(url_for('home')) #need to insert url for the employee page HERE
        else:
            # Account doesnt exist or username/password incorrect
            msg = 'Incorrect username/password!'
    # Show the login form with message (if any)
    return render_template('login.php', msg=msg)
    # http://localhost:5000/python/logout - this will be the logout page

@app.route('/logout')
def logout():
    # Remove session data, this will log the user out
   session.pop('loggedin', None)
   session.pop('id', None)
   session.pop('username', None)
   # Redirect to login page
   return redirect(url_for('login'))

@app.route('/register', methods=['GET', 'POST'])
def register():
    # Output message if something goes wrong...
    msg = ''
    # Check if "username", "password" and "email" POST requests exist (user submitted form)
    if request.method == 'POST' and 'username' in request.form and 'password' in request.form and 'first_name' in request.form and 'last_name' in request.form:
        # Create variables for easy access
        username = request.form['username']
        password = request.form['password']
        firstName = request.form['first_name']
        lastName = request.form['last_name']
        # Check if account exists using MySQL
        cursor = mysql.connection.cursor(MySQLdb.cursors.DictCursor)
        cursor.execute('SELECT * FROM User WHERE username = %s', (username,))
        account = cursor.fetchone()
        # If account exists show error and validation checks
        if account:
            msg = 'Account already exists!'
        elif not re.match(r'[A-Za-z0-9]+', username):
            msg = 'Username must contain only characters and numbers!'
        elif not username or not password:
            msg = 'Please fill out the form!'
        else:
            # Account doesnt exists and the form data is valid, now insert new account into accounts table
            cursor.execute('INSERT INTO User VALUES (%s, %s, %s, %s, Null, 1)', (username, password, firstName, lastName))
            mysql.connection.commit()
            msg = 'You have successfully registered!'
    elif request.method == 'POST':
        # Form is empty... (no POST data)
        msg = 'Please fill out the form!'
    # Show registration form with message (if any)
    return render_template('register.php', msg=msg)

