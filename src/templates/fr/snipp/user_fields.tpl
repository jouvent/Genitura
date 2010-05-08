    <p>
        <label for="user_name">Nom</label>
        <select name="user_sex" id="user_sex">
            <option value="m" {% if user.sex == 'm' %} selected="selected" {% endif %}>Mr.</option>
            <option value="f" {% if user.sex == 'f' %} selected="selected" {% endif %}>Mrs.</option>
        </select>
        <input type="text" name="user_name" id="user_name" value="{{user.name}}" />
        {% if errors.user.name.notblank %}
        <label for="user_name" class="error">
            Vous devez entrer votre Nom (au format: Prenom, Nom)
        </label>
        {% endif %}
    </p>
    <p>
        <label for="user_login_email">Courriel</label>
        <input type="text" name="user_login_email" id="user_login_email" value="{{user.login_email}}" />
        {% if errors.user.login_email.email %}
        <label for="user_name" class="error">
            Vous devez entrer un courriel valide
        </label>
        {% endif %}
        {% if errors.user.login_email.unique %}
        <label for="user_name" class="error">
            Ce Courriel est d&eacute;j&agrave; pr&eacute;sent dans la base de donn&eacute;e
        </label>
        {% endif %}
    </p>
    <p>
        <label for="user_tel1">T&eacute;l&eacute;phone</label>
        <input type="text" name="user_tel1" id="user_tel1" value="{{user.tel1}}" />
    </p>
    <p>
        <label for="user_tel2">Cellulaire</label>
        <input type="text" name="user_tel2" id="user_tel2" value="{{user.tel2}}" />
    </p>
    <p>
        <label for="user_address">Addresse</label>
        <textarea name="user_address" id="user_address" >{{user.address}}</textarea>
    </p>
{% if logged.type == 'A' %}
<p>
    <label for="user_invite_quotas">Nb. d'invitations que cette personne pourra distribuer</label>
    <input type="text" name="user_invite_quotas" id="user_invite_quotas" value="{{user.invite_quotas}}" />
</p>
{% endif %}

