
<h3>Le Chef de Bus</h3>

    <p>
        <label for="user_name">Nom</label>
        <select name="bus[Chief][sex]" id="user_sex">
            <option value="m" {% if bus.Chief.sex == 'm' %} selected="selected" {% endif %}>Mr.</option>
            <option value="f" {% if bus.Chief.sex == 'f' %} selected="selected" {% endif %}>Mrs.</option>
        </select>
        <input type="text" name="bus[Chief][name]" id="user_name" value="{{bus.Chief.name}}" />
        {% if errors.bus.Chief.name.notblank %}
        <label for="user_name" class="error">
            Vous devez entrer votre Nom (au format: Prenom, Nom)
        </label>
        {% endif %}
    </p>
    <p>
        <label for="user_login_email">Courriel</label>
        <input type="text" name="bus[Chief][login_email]" id="user_login_email" value="{{bus.Chief.login_email}}" />
        {% if errors.bus.Chief.login_email.email %}
        <label for="user_name" class="error">
            Vous devez entrer un courriel valide
        </label>
        {% endif %}
        {% if errors.bus.Chief.login_email.unique %}
        <label for="bus[Chief][name]" class="error">
            Ce Courriel est d&eacute;j&agrave; pr&eacute;sent dans la base de donn&eacute;e
        </label>
        {% endif %}
    </p>
    <p>
        <label for="user_tel1">T&eacute;l&eacute;phone</label>
        <input type="text" name="bus[Chief][tel1]" id="user_tel1" value="{{bus.Chief.tel1}}" />
    </p>
    <p>
        <label for="user_tel2">Cellulaire</label>
        <input type="text" name="bus[Chief][tel2]" id="user_tel2" value="{{bus.Chief.tel2}}" />
    </p>
    <p>
        <label for="user_address">Addresse</label>
        <textarea name="bus[Chief][address]" id="user_address" >{{bus.Chief.address}}</textarea>
    </p>
{% if logged.type == 'A' %}
<p>
    <label for="user_invite_quotas">Nb. d'invitations que cette personne pourra distribuer</label>
    <input type="text" name="bus[Chief][invite_quotas]" id="user_invite_quotas" value="{{bus.Chief.invite_quotas}}" />
</p>
{% endif %}

<h3>Le Bus</h3>
<p>
    <label for="bus_name">Nom / Location du bus</label>
    <input type="text" name="bus[name]" id="bus_name" value="{{bus.name}}" />
    {% if errors.bus.name.notblank %}
    <label for="user_name" class="error">
        Vous devez entrer un nom pour ce Bus.
    </label>
    {% endif %}
</p>

<p>
    <label for="bus_name">Location du bus</label>
    <input type="text" name="bus[location]" id="bus_name" value="{{bus.location}}" />
</p>
<p>
    <label for="bus_name">Lien Google Maps</label>
    <input type="text" name="bus[googlemaps_url]" id="bus_name" value="{{bus.googlemaps_url}}" />
</p>

{% if logged.type == 'A' %}

<h3>Les quantites d'invites pour le bus</h3>
<p>
    <label for="bus_size">Nb. de places dans le bus</label>
    <input type="text" name="bus[size]" id="bus_size" value="{{bus.size}}" />
</p>
{% endif %}

