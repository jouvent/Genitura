<h3>Le Groupe</h3>
<p>
    <label for="group_name">Nom / Location du groupe</label>
    <input type="text" name="group[name]" id="group_name" value="{{group.name}}" />
    {% if errors.group.name.notblank %}
    <label for="user_name" class="error">
        Vous devez entrer un nom pour ce Groupe.
    </label>
    {% endif %}
</p>

<h3>Le Chef de Groupe</h3>

    <p>
        <label for="user_name">Nom</label>
        <select name="group[Chief][sex]" id="user_sex">
            <option value="m" {% if group.Chief.sex == 'm' %} selected="selected" {% endif %}>Mr.</option>
            <option value="f" {% if group.Chief.sex == 'f' %} selected="selected" {% endif %}>Mrs.</option>
        </select>
        <input type="text" name="group[Chief][name]" id="user_name" value="{{group.Chief.name}}" />
        {% if errors.group.Chief.name.notblank %}
        <label for="user_name" class="error">
            Vous devez entrer votre Nom (au format: Prenom, Nom)
        </label>
        {% endif %}
    </p>
    <p>
        <label for="user_login_email">Courriel</label>
        <input type="text" name="group[Chief][login_email]" id="user_login_email" value="{{group.Chief.login_email}}" />
        {% if errors.group.Chief.login_email.email %}
        <label for="user_name" class="error">
            Vous devez entrer un courriel valide
        </label>
        {% endif %}
        {% if errors.group.Chief.login_email.unique %}
        <label for="group[Chief][name]" class="error">
            Ce Courriel est d&eacute;j&agrave; pr&eacute;sent dans la base de donn&eacute;e
        </label>
        {% endif %}
    </p>
    <p>
        <label for="user_tel1">T&eacute;l&eacute;phone</label>
        <input type="text" name="group[Chief][tel1]" id="user_tel1" value="{{group.Chief.tel1}}" />
    </p>
    <p>
        <label for="user_tel2">Cellulaire</label>
        <input type="text" name="group[Chief][tel2]" id="user_tel2" value="{{group.Chief.tel2}}" />
    </p>
    <p>
        <label for="user_address">Addresse</label>
        <textarea name="group[Chief][address]" id="user_address" >{{group.Chief.address}}</textarea>
    </p>
{% if logged.type == 'A' %}
<p>
    <label for="user_invite_quotas">Nb. d'invitations que cette personne pourra distribuer</label>
    <input type="text" name="group[Chief][invite_quotas]" id="user_invite_quotas" value="{{group.Chief.invite_quotas}}" />
</p>
{% endif %}

