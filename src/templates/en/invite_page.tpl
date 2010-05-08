{% extends "organisation_base.tpl" %}

{% block action_list %}
    <li>{{user.invite_status|status|safe}}</li>
    <li><a href="/invite/edit/{{user.id}}">Edit</a></li>
{% endblock %}

{% block column_left %}
    <h3>My Table</h3>
    {% include 'snipp/user_info.tpl' %}
    <h4><a href="/user/page/{{in_couple.id}}">{{in_couple.name}}</a></h4>

    <p>Have their own equipement: {{couple.own_table|bool}}<br/>
    Order: {{basket_simple.table}} Tables, {{basket_simple.chair}} Chairs, {{basket_simple.basket}} Baskets</p>
    {% if couple.own_table %}
    {% else %}
    <p><a href="/purchase">Order tables and chairs</a></p>
    {% endif %}

    {% if has_friends %}
    <h3>Autre Table</h3>
    <h4><a href="/user/page/{{friend_1.id}}">{{friend_1.name}}</a></h4>
    <h4><a href="/user/page/{{friend_2.id}}">{{friend_2.name}}</a></h4>

    <p>Have their own equipement: {{friends.own_table|bool}}<br/>
    Order: {{friend_basket_simple.table}} Tables, {{friend_basket_simple.chair}} Chairs, {{friend_basket_simple.basket}} Baskets</p>

    {% endif %}
{% endblock %}

{% block column_right %}
    <h3>Counters</h3>
    <form>
        <p class="data_row">
            <span class="legend">Group Chief</span>
            <span class="data_box {{user.type|slug_title}}">{{group_chief.name}}</span>
        </p>
        <p class="data_row">
            <span class="legend">Bus Chief</span>
            <span class="data_box {{user.type|slug_title}}">{{bus_chief.name}}</span>
        </p>
        <p class="data_row">
            <span class="legend">Invited from</span>
            <span class="data_box {{user.type|slug_title}}">{% if inviter == 'prev' %} DEB 2009 {% else %}{{inviter.name}}{% endif %}</span>
        </p>
        <p class="data_row">
            <span class="legend">Would like to sit next to</span>
            <span class="data_box {{user.type|slug_title}}">{{user.sit_next_to}}</span>
        </p>
        <h3>Paying Guest</h3>
    <p class="data_row">
        <span class="legend">Name</span>
        <span class="data_box {{user.type|slug_title}}" >{{inv_pay.sex|gender}} {{inv_pay.name}}</span>
    </p>
    <p class="data_row">
        <span class="legend">Email</span>
        <span class="data_box {{user.type|slug_title}}" >{{inv_pay.login_email}}</span>
    </p>
    <p class="data_row">
        <span class="legend">Telephone</span>
        <span class="data_box {{user.type|slug_title}}" >{{inv_pay.tel1}}</span>
    </p>
    <p class="data_row">
        <span class="legend">Cell</span>
        <span class="data_box {{user.type|slug_title}}" >{{inv_pay.tel2}}</span>
    </p>
    <p class="data_row">
        <span class="legend">Address</span>
        <span class="data_box {{user.type|slug_title}}" >{{inv_pay.address}}</span>
    </p>
    </form>

    <h3>Email</h3>
    <form name="email" id="email" action="/email/all" method="post">
        <p>Email to all guests</p>
        <p><label for="email_subject">Subject:</label><input type="text" name="email_subject" id="email_subject"/></p>
        <p><label for="email_body">Content:</label><textarea name="email_body"></textarea></p>
        <p><label for="attachement">Attach a File</label><input type="file" name="attachement" id="attachement" /> </p>
        <p><input type="reset" value="Cancel"/><input name="submit" type="submit" value="Send"/></p>
    </form>
    <script type="text/javascript">
        $(document).ready(function() {
            // handle form submit in javascript
            $('#email').ajaxForm(function() {
                alert("Email sent!");
            });
        });
    </script>
{% endblock %}

{% block no_column %}
    {% if logged.type == 'A' %}
    <h3>Basket Summary</h3>
    {{basket|safe}}
    {% endif %}
{% endblock %}




