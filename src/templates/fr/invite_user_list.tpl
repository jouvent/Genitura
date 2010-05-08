{% extends 'organisation_base.tpl' %}

{% block content %}
<h3>Liste des Invit&eacute;s de {{inviter.name}}</h3>
{% include 'snipp/user_list.tpl' %}

<p>{{inviter.invite_count}} invitations envoy&eacute;es sur {% if inviter.invite_quotas != '-1' %}{{inviter.invite_quotas}}{% else %} (pas de limite) {% endif %}
{% if inviter.id == logged.id %}
    {% if inviter.invite_quotas == '-1' %}
        {% include 'snipp/invite_form.tpl' %}
    {% endif %}
    {% if inviter.invite_quotas > inviter.invite_count %}
        {% include 'snipp/invite_form.tpl' %}
    {% endif %}
{% endif %}
{% endblock %}
