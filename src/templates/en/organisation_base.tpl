<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"Transitional"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="en">
    <head>
        <link rel="stylesheet" type="text/css" href="/media/css/style.css" />
        <link rel="stylesheet" type="text/css" href="/media/css/organisation.css" />
        <script type="text/javascript" src="/media/js/functions.js"></script>
        <script type="text/javascript" src="/media/js/heptafunctions.js"></script>
        <script type="text/javascript" src="/media/js/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="/media/js/jquery.form.js"></script>
        <script type="text/javascript" src="/media/js/jquery.validate.min.js"></script>
    </head>
    <body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <div id="container">
        <div id="header">
        <h2>D&icirc;ner en Blanc - Organisation</h2>
        {% if logged.type != 'S' %}
        <p class="search_box"><form id="search" name="serach" action="/user/search" method="get" ><input type="text" name="search" /> <input type="submit" value="Go" /></form></p>
        {% endif %}
        <div style="clear: both;"> </div>
            <div id="menuBar">
                <ul class="menu">
                    <li><a href="/mypage">{{logged.name}}</a></li>
                </ul>
                <ul class="menu right">
                    <li>{{logged.type|title|safe}}</li>
                    {% if logged.type != 'S' %}
                    <li><a href="/settings">Settings</a></li>
                    {% endif %}
                    <li><a href="/">Web Site</a> </li>
                    <li><a href="/logout">Logout</a></li>
                    {% if logged.type != 'S' %}
                    <li><a href="">Export CSV</a></li>
                    {% endif %}
                </ul>
            </div>
        </div>
        <div id="mainContent">
        {% block content %}
        <div id="page" class="{{user.type|slug_title|safe}}_border">
            <div id="sub_header" class="{{user.type|slug_title|safe}}">
                <span class="ariane">{% block ariane %}<a href="/user/page/{{user.id}}">{% if invite_payeur %}<b>{% endif %}{{user.name}} registration date {{user.registration_date}}{% if invite_payeur %}</b>{% endif %}</a>{% endblock %}</span>
                <ul class="sub_menu right">
                    {% block action_list %}
                    {% endblock %}
                </ul>
            </div>
            <div style="clear:both"></div>
            <div id="column_left">
                {% block column_left %}
                {% endblock %}
            </div>
            <div id="column_right">
                {% block column_right %}
                {% endblock %}
            </div>
            <div style="clear:both"></div>
            <div id="no_column">
                {% block no_column %}
                {% endblock %}
            </div>
        </div><!-- end page -->
        {% endblock %}
        </div><!-- end mainContent -->
        </div><!-- end container -->
    </body>
</html>
