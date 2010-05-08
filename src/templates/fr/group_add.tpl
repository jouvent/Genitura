{% extends 'organisation_base.tpl' %}

{% block content %}

<h3>Ajouter un nouveau Groupe</h3>

{% include 'snipp/message.tpl' %}
<form method="post" action="" id="group_add" name="group_add" >

    {% include 'snipp/group_form.tpl' %}

    <p><input type="submit" name="save" value="Creer" /></p>

</form>

{% endblock %}
