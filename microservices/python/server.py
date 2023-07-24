import os
from uploader import upload_file
from flask import Flask, flash, request, redirect, url_for
from werkzeug.utils import secure_filename

UPLOAD_FOLDER = '../../uploads'
ALLOWED_EXTENSIONS = { 'txt', 'pdf', 'png', 'jpeg', 'gif', 'doc', 'docx' }

app = Flask(__name__)
app.config['UPLOAD_FOLDER'] = UPLOAD_FOLDER

@app.route('/ms/uploader', methods = [ 'GET', 'POST' ])
def upload_file_route():
    return upload_file()

if __name__ == '__main__':
    app.run(debug = True)