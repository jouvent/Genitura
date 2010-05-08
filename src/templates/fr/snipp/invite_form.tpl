<h3>Envoyer une Invitation</h3>
{% include 'snipp/message.tpl' %}
{% if errors.inviter.can_invite %}
<span class="error">Vous n'avez plus d'invitations disponibles</span>
{% endif %}
<form method="post" action="/invitation/invite">
    <p>
    {% include 'snipp/group_bus_select.tpl' %}
    </p>
    {% include 'snipp/user_fields.tpl' %}
    <input type="submit" value="Inviter" />
</form>
