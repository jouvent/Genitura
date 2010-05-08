{% extends 'organisation_base.tpl' %}

{% block content %}

{% if message %}
    <p class="{{message_type}}">{{message}}</p> 
{% endif %}

<form method="post" action="" id="group_add" name="group_add" >
<p>
    <label for="group_name">Nom / Location du groupe</label>
    <input type="text" name="group_name" id="group_name" value="{{group.group_name}}" />
</p>

{% include 'snipp/user_info.tpl' %}

<p><input type="submit" name="save" value="Creer" /></p>

</form>

{% endblock %}
