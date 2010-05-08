{% extends "invite_page.tpl" %}

{% block column_left %}{% endblock %}
{% block column_right %}{% endblock %}

{% block no_column %}

<h3>Modifer l'Invit&eacute;: {{user.name}}</h3>
{% include 'snipp/message.tpl' %}
<form method="post" action="">

    <p>
    Dans le groupe / bus {{group.name}} {{bus.name}}
    </p>
    <table width="100%"><tr><td>
    {% include 'snipp/user_fields.tpl' %}
    </td>
    <td>
    {% include 'snipp/couple_fields.tpl' %}
    </td></tr>
    <tr><td>
    {% include 'snipp/friend_1_fields.tpl' %}
    </td>
    <td>
    {% include 'snipp/friend_2_fields.tpl' %}
    </td></tr></table>

    <p><input type="submit" value="Enregistrer" /></p>
</form>

{% endblock %}
