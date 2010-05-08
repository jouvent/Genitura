{% extends "group_page.tpl" %}

{% block column_left %}{% endblock %}
{% block column_right %}{% endblock %}

{% block no_column %}

<h3>Modify Group: {{user.name}}</h3>
{% include 'snipp/message.tpl' %}
<form method="post" action="">

    {% include 'snipp/group_form.tpl' %}

    <p><input type="submit" value="Save" /></p>
</form>

{% endblock %}
