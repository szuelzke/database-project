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
app.config['MYSQL_DB'] = 'merch_inventory'

# Intialize MySQL
mysql = MySQL(app)


@app.route('/database-project/home.php', methods=['GET', 'POST'])
def home():
     msg = ''
     return render_template('home.php', msg = msg)

@app.route('/database-project/AboutUs.html')
def about():
     msg = ''
     return render_template('AboutUs.html', msg=msg)

@app.route('/database-project/products.php')
def shop():
    msg = ''
    return render_template('employee.html', msg=msg)

@app.route('/database-project/login.php')
def emp():
    if 'loggedin' not in session:
        return redirect(url_for('login'))

    msg = ''
    return render_template('login.php', msg=msg)

