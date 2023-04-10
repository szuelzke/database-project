from flask import Flask, render_template, request, redirect, url_for, session
#from flask_mysqldb import MySQL
from ast import literal_eval
#import MySQLdb.cursors
import re

app = Flask(__name__)

# Change this to your secret key (can be anything, it's for extra protection)
# app.secret_key = 'your secret key'

# Enter your database connection details below
# app.config['MYSQL_HOST'] = 'localhost'
# app.config['MYSQL_USER'] = ''
# app.config['MYSQL_PASSWORD'] = ''
# app.config['MYSQL_DB'] = ''

# Intialize MySQL
#mysql = MySQL(app)
# CORS(app)

@app.route('/home.html', methods=['GET', 'POST'])
def home():
     msg = ''
     return render_template('home.html', msg = msg)

@app.route('/AboutUs.html')
def about():
     msg = ''
     return render_template('AboutUs.html', msg=msg)

@app.route('/EmployeePortal.html')
def emp():
    if 'loggedin' not in session:
        return redirect(url_for('login'))

    msg = ''
    return render_template('employee.html', msg=msg)

@app.route('/shop.html')
def shop():
    msg = ''
    return render_template('employee.html', msg=msg)

@app.route('/Login.html')
def emp():
    if 'loggedin' not in session:
        return redirect(url_for('login'))

    msg = ''
    return render_template('login.html', msg=msg)
     
##
# def login():
    # Output message if something goes wrong...
    #msg = ''
    # Check if "username" and "password" POST requests exist (user submitted form)
    #if request.method == 'POST' and 'username' in request.form and 'password' in request.form:
        # Create variables for easy access
        #username = request.form['username']
        #password = request.form['password']
        # Check if account exists using MySQL
        # cursor = mysql.connection.cursor(MySQLdb.cursors.DictCursor)
        #cursor.execute('SELECT * FROM User WHERE username = %s AND password = %s', (username, password,))
        # Fetch one record and return result
        #User = cursor.fetchone()
        # If account exists in accounts table in out database
        #if User:
         #   # Create session data, we can access this data in other routes
          #  session['loggedin'] = True
           # #session['id'] = User['id']
            #session['username'] = User['username']
            # Redirect to home page
           # return redirect(url_for('home')) #need to insert url for the employee page HERE
        #else:
            # Account doesnt exist or username/password incorrect
           # msg = 'Incorrect username/password!'
    # Show the login form with message (if any)
    #return render_template('login.html', msg=msg)

