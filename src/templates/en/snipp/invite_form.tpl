<h3>Send an Invitation</h3>
{% include 'snipp/message.tpl' %}
{% if errors.inviter.can_invite %}
<span class="error">You don't have any invitations left</span>
{% endif %}
<form method="post" action="/invitation/invite">
    <p>
    {% include 'snipp/group_bus_select.tpl' %}
    </p>
    {% include 'snipp/user_fields.tpl' %}
    <input type="submit" value="Inviter" />
</form>
