<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"Transitional"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="en">
    <head>
        <link rel="stylesheet" type="text/css" href="/media/css/style.css" />
        <link rel="stylesheet" type="text/css" href="/media/css/organisation.css" />
        <script type="text/javascript" src="/include/js/functions.js"></script>
        <script type="text/javascript" src="/include/js/heptafunctions.js"></script>
        <script type="text/javascript" src="/include/js/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="/include/js/jquery.form.js"></script>
        <script type="text/javascript" src="/include/js/jquery.validate.min.js"></script>
    </head>
    <body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <div id="container">
        <div id="header">
        <h2>Diner en Blanc - Organisation</h2>
        <p class="search_box"><form id="search" name="serach" ><input type="text" /> <input type="submit" value="Go" /></form></p>
        <div style="clear: both;"> </div>
        <div id="menuBar">
        <ul class="menu">
            <li>{{logged.name}}</li>
        </ul>
        <ul class="menu right">
            <li>{{logged_credits|safe}}</li>
            <li><a href="/admin/index.php">Setings</a></li>
            <li><a href="/logout">Logout</a></li>
            <li><a href="">Export CSV</a></li>
        </ul>
        </div>
        </div>
        <div id="mainContent">
    {% block content %}
    {% endblock %}
        </div>
        </div>
    </body>
</html>
