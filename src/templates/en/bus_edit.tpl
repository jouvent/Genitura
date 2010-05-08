{% extends "bus_page.tpl" %}

{% block column_left %}{% endblock %}
{% block column_right %}{% endblock %}

{% block no_column %}

<h3>Modify Bus: {{bus.name}}</h3>

{% include 'snipp/message.tpl' %}
<form method="post" action="">

    {% include 'snipp/bus_form.tpl' %}

    <p><input type="submit" value="Save" /></p>
</form>

{% endblock %}
