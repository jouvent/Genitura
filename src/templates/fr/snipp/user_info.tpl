    <p class="data_row">
        <span class="legend">Nom</span>
        <span class="data_box {{user.type|slug_title}}" >{{user.sex|gender}} {{user.name}}</span>
    </p>
    <p class="data_row">
        <span class="legend">Couriel</span>
        <span class="data_box {{user.type|slug_title}}" >{{user.login_email}}</span>
    </p>
    <p class="data_row">
        <span class="legend">T&eacute;l&eacute;phone</span>
        <span class="data_box {{user.type|slug_title}}" >{{user.tel1}}</span>
    </p>
    <p class="data_row">
        <span class="legend">Cellulaire</span>
        <span class="data_box {{user.type|slug_title}}" >{{user.tel2}}</span>
    </p>
    <p class="data_row">
        <span class="legend">Adresse</span>
        <span class="data_box {{user.type|slug_title}}" >{{user.address}}</span>
    </p>
{% if logged.type == 'A' %}
    <p class="data_row">
    <span class="legend">Nb. d'invitations &agrave; distribuer</span>
    <span class="data_box {{user.type|slug_title}}" >{{user.invite_quotas}}</span>
</p>
{% endif %}

