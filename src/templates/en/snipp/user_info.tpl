    <p class="data_row">
        <span class="legend">Name</span>
        <span class="data_box {{user.type|slug_title}}" >{{user.sex|gender}} {{user.name}}</span>
    </p>
    <p class="data_row">
        <span class="legend">Email</span>
        <span class="data_box {{user.type|slug_title}}" >{{user.login_email}}</span>
    </p>
    <p class="data_row">
        <span class="legend">Phone</span>
        <span class="data_box {{user.type|slug_title}}" >{{user.tel1}}</span>
    </p>
    <p class="data_row">
        <span class="legend">Cell</span>
        <span class="data_box {{user.type|slug_title}}" >{{user.tel2}}</span>
    </p>
    <p class="data_row">
        <span class="legend">Address</span>
        <span class="data_box {{user.type|slug_title}}" >{{user.address}}</span>
    </p>
{% if logged.type == 'A' %}
    <p class="data_row">
    <span class="legend">invitations available for this person</span>
    <span class="data_box {{user.type|slug_title}}" >{{user.invite_quotas}}</span>
</p>
{% endif %}

