{% extends 'base.html' %}

{% block body %}
<div id="registration_step">
<ul>
    <li class="{{logged.invite_status|register_step 0}}">
        <a href="/registration">Invitation key</a>
    </li>
    <li class="{{logged.invite_status|register_step 1}}">
    {% if 0 < logged.invite_status %}
        <a href="/registration/tablee">My Table</a>
    {% else %}
        Ma table
    {% endif %}
    </li>
    <li class="{{logged.invite_status|register_step 2}}">
    {% if 1 < logged.invite_status %}
        <a href="/registration/friends">Invite Friends</a>
    {% else %}
        Inviter des Amis
    {% endif %}
    </li>
    <li class="{{logged.invite_status|register_step 3}}">
    {% if 2 < logged.invite_status %}
        <a href="/registration/paypal">Payment</a>
    {% else %}
        Payement
    {% endif %}
    </li>
    <li class="{{logged.invite_status|register_step 4}}">
    {% if 3 < logged.invite_status %}
        <a href="/registration">End</a>
    {% else %}
        Fin
    {% endif %}
    </li>
</ul>
</div>
<div id="registration_form">
 {% block form%}
 {% endblock %}
</div>
{% endblock %}
