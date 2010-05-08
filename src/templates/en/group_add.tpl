{% extends 'organisation_base.tpl' %}

{% block content %}

<h3>Add a new Group</h3>

{% include 'snipp/message.tpl' %}
<form method="post" action="" id="group_add" name="group_add" >

    {% include 'snipp/group_form.tpl' %}

    <p><input type="submit" name="save" value="Save" /></p>

</form>

{% endblock %}
