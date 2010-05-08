{% extends 'organisation_base.tpl' %}

{% block content %}

<h3> Ajouter un nouveau Bus</h3>

{% include 'snipp/message.tpl' %}
<form method="post" action="" id="bus_add" name="bus_add" >

    {% include 'snipp/bus_form.tpl' %}

    <p><input type="submit" name="save" value="Creer" /></p>

</form>

{% endblock %}
