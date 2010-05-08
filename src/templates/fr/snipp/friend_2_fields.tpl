    <p>
        <label for="friend_2_name">Nom</label>
        <select name="friend_2_sex" id="friend_2_sex">
            <option value="m" {% if friend_2.sex == 'm' %} selected="selected" {% endif %}>Mr.</option>
            <option value="f" {% if friend_2.sex == 'f' %} selected="selected" {% endif %}>Mrs.</option>
        </select>
        <input type="text" name="friend_2_name" id="friend_2_name" value="{{friend_2.name}}" />
        {% if errors.friend_2.name.notblank %}
        <label for="friend_2_name" class="error">
            Vous devez entrer votre Nom (au format: Prenom, Nom)
        </label>
        {% endif %}
    </p>
    <p>
        <label for="friend_2_login_email">Courriel</label>
        <input type="text" name="friend_2_login_email" id="friend_2_login_email" value="{{friend_2.login_email}}" />
        {% if errors.friend_2.login_email.email %}
        <label for="friend_2_name" class="error">
            Vous devez entrer un courriel valide
        </label>
        {% endif %}
        {% if errors.friend_2.login_email.unique %}
        <label for="friend_2_name" class="error">
            Ce Courriel est d&eacute;j&agrave; pr&eacute;sent dans la base de donn&eacute;e
        </label>
        {% endif %}
    </p>
    <p>
        <label for="friend_2_tel1">T&eacute;l&eacute;phone</label>
        <input type="text" name="friend_2_tel1" id="friend_2_tel1" value="{{friend_2.tel1}}" />
    </p>
    <p>
        <label for="friend_2_tel2">Cellulaire</label>
        <input type="text" name="friend_2_tel2" id="friend_2_tel2" value="{{friend_2.tel2}}" />
    </p>
    <p>
        <label for="friend_2_address">Addresse</label>
        <textarea name="friend_2_address" id="friend_2_address" >{{friend_2.address}}</textarea>
    </p>
{% if logged.type == 'A' %}
<p>
    <label for="friend_2_invite_quotas">Nb. d'invitations que cette personne pourra distribuer</label>
    <input type="text" name="friend_2_invite_quotas" id="friend_2_invite_quotas" value="{{friend_2.invite_quotas}}" />
</p>
{% endif %}