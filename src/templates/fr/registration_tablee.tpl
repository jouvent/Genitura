{% extends 'registration_base.tpl' %}

{% block form %}
    {% include 'snipp/message.tpl' %}

    <form action="" method="post" name="registration_userinfo" >
    <h4>D&eacute;tail des participants</h4>
    <fieldset>
    <legend>Table 1</legend>
    {% if errors.friendship.Couples.0.homosexual_couple %}
    <label for="user_name" class="error">
    Chaque table doit accueillir un homme et une femme.
    </label><br/>
    {% endif %}
    <span>Vous:</span>
    <p>
        <label for="couple_name">Nom</label>
        <select name="friendship[Couples][0][Users][0][sex]" id="couple_sex">
            <option value="m" {% if friendship.Couples.0.Users.0.sex == 'm' %} selected="selected" {% endif %}>Mr.</option>
            <option value="f" {% if friendship.Couples.0.Users.0.sex == 'f' %} selected="selected" {% endif %}>Mrs.</option>
        </select>
        <input type="text" name="friendship[Couples][0][Users][0][name]" id="couple_name" value="{{friendship.Couples.0.Users.0.name}}" />
        {% if errors.user.friendship.Couples.0.Users.0.notblank %}
        <label for="user_name" class="error">
            Vous devez entrer un Nom (au format: Prenom, Nom)
        </label>
        {% endif %}
    </p>
    <p>
        <label for="couple_login_email">Couriel</label>
        <input type="text" name="friendship[Couples][0][Users][0][login_email]" id="couple_login_email" value="{{friendship.Couples.0.Users.0.login_email}}" />
        {% if errors.friendship.Couples.0.Users.0.login_email.email %}
        <label for="user_name" class="error">
            Vous devez entrer un courriel valide
        </label>
        {% endif %}
        {% if errors.friendship.Couples.0.Users.0.login_email.unique %}
        <label for="user_name" class="error">
            Ce Courriel est d&eacute;j&agrave; pr&eacute;sent dans la base de donn&eacute;e
        </label>
        {% endif %}
    </p>
    <p>
        <label align="right">Password</label>
        <input type="password" id="password" name="password" size="25">
        {% if errors.friendship.Couples.0.Users.0.password.valid %}
        <label for="user_name" class="error">
        Mot de passe invalide.
        </label>
        {% endif %}
    </p>

    <p><label align="right">Confirmation</label>
        <input type="password" id="confirmpassword" name="confirmpassword" size="25"></p>
    <p>
        <label for="couple_tel1">T&eacute;l&eacute;phone</label>
        <input type="text" name="friendship[Couples][0][Users][0][tel1]" id="couple_tel1" value="{{friendship.Couples.0.Users.0.tel1}}" />
    </p>
    <p>
        <label for="couple_tel2">Cellulaire</label>
        <input type="text" name="friendship[Couples][0][Users][0][tel2]" id="couple_tel2" value="{{friendship.Couples.0.Users.0.tel2}}" />
    </p>
    <p>
        <label for="couple_address">Addresse</label>
        <textarea name="friendship[Couples][0][Users][0][address]" id="couple_address" >{{friendship.Couples.0.Users.0.address}}</textarea>
    </p>

    <p></p>

    <p>
        <label for="couple_name">Nom</label>
        <select name="friendship[Couples][0][Users][1][sex]" id="couple_sex">
            <option value="m" {% if friendship.Couples.0.Users.1.sex == 'm' %} selected="selected" {% endif %}>Mr.</option>
            <option value="f" {% if friendship.Couples.0.Users.1.sex == 'f' %} selected="selected" {% endif %}>Mrs.</option>
        </select>
        <input type="text" name="friendship[Couples][0][Users][1][name]" id="couple_name" value="{{friendship.Couples.0.Users.1.name}}" />
        {% if errors.friendship.Couples.0.Users.1.notblank %}
        <label for="user_name" class="error">
            Vous devez entrer un Nom (au format: Prenom, Nom)
        </label>
        {% endif %}
    </p>
    <p>
        <label for="couple_login_email">Couriel</label>
        <input type="text" name="friendship[Couples][0][Users][1][login_email]" id="couple_login_email" value="{{friendship.Couples.0.Users.1.login_email}}" />
        {% if errors.friendship.Couples.0.Users.1.login_email.email %}
        <label for="user_name" class="error">
            Vous devez entrer un courriel valide
        </label>
        {% endif %}
        {% if errors.friendship.Couples.0.Users.1.login_email.unique %}
        <label for="user_name" class="error">
            Ce Courriel est d&eacute;j&agrave; pr&eacute;sent dans la base de donn&eacute;e
        </label>
        {% endif %}
    </p>
    <p>
        <label for="couple_tel1">T&eacute;l&eacute;phone</label>
        <input type="text" name="friendship[Couples][0][Users][1][tel1]" id="couple_tel1" value="{{friendship.Couples.0.Users.1.tel1}}" />
    </p>
    <p>
        <label for="couple_tel2">Cellulaire</label>
        <input type="text" name="friendship[Couples][0][Users][1][tel2]" id="couple_tel2" value="{{friendship.Couples.0.Users.1.tel2}}" />
    </p>
    <p>
        <label for="couple_address">Addresse</label>
        <textarea name="friendship[Couples][0][Users][1][address]" id="couple_address" >{{friendship.Couples.0.Users.1.address}}</textarea>
    </p>

    </fieldset>

    <p>
        <h4><input type="checkbox" name="friends" id="table2check" value="yes" {% if friends %} checked="checked" {% endif %}/> Je souhaite r&eacute;server une autre table</h4>
    </p>

    <fieldset id="table2">
    <legend>Table 2</legend>
    {% if errors.friendship.Couples.1.homosexual_couple %}
    <label for="user_name" class="error">
    Chaque table doit accueillir un homme et une femme.
    </label><br/>
    {% endif %}

    <p>
        <label for="couple_name">Nom</label>
        <select name="friendship[Couples][1][Users][0][sex]" id="couple_sex">
            <option value="m" {% if friendship.Couples.1.Users.0.sex == 'm' %} selected="selected" {% endif %}>Mr.</option>
            <option value="f" {% if friendship.Couples.1.Users.0.sex == 'f' %} selected="selected" {% endif %}>Mrs.</option>
        </select>
        <input type="text" name="friendship[Couples][1][Users][0][name]" id="couple_name" value="{{friendship.Couples.1.Users.0.name}}" />
        {% if errors.user.friendship.Couples.1.Users.0.notblank %}
        <label for="user_name" class="error">
            Vous devez entrer un Nom (au format: Prenom, Nom)
        </label>
        {% endif %}
    </p>
    <p>
        <label for="couple_login_email">Couriel</label>
        <input type="text" name="friendship[Couples][1][Users][0][login_email]" id="couple_login_email" value="{{friendship.Couples.1.Users.0.login_email}}" />
        {% if errors.friendship.Couples.1.Users.0.login_email.email %}
        <label for="user_name" class="error">
            Vous devez entrer un courriel valide
        </label>
        {% endif %}
        {% if errors.friendship.Couples.1.Users.0.login_email.unique %}
        <label for="user_name" class="error">
            Ce Courriel est d&eacute;j&agrave; pr&eacute;sent dans la base de donn&eacute;e
        </label>
        {% endif %}
    </p>
    <p>
        <label for="couple_tel1">T&eacute;l&eacute;phone</label>
        <input type="text" name="friendship[Couples][1][Users][0][tel1]" id="couple_tel1" value="{{friendship.Couples.1.Users.0.tel1}}" />
    </p>
    <p>
        <label for="couple_tel2">Cellulaire</label>
        <input type="text" name="friendship[Couples][1][Users][0][tel2]" id="couple_tel2" value="{{friendship.Couples.1.Users.0.tel2}}" />
    </p>
    <p>
        <label for="couple_address">Addresse</label>
        <textarea name="friendship[Couples][1][Users][0][address]" id="couple_address" >{{friendship.Couples.1.Users.0.address}}</textarea>
    </p>

    <p></p>

    <p>
        <label for="couple_name">Nom</label>
        <select name="friendship[Couples][1][Users][1][sex]" id="couple_sex">
            <option value="m" {% if friendship.Couples.1.Users.1.sex == 'm' %} selected="selected" {% endif %}>Mr.</option>
            <option value="f" {% if friendship.Couples.1.Users.1.sex == 'f' %} selected="selected" {% endif %}>Mrs.</option>
        </select>
        <input type="text" name="friendship[Couples][1][Users][1][name]" id="couple_name" value="{{friendship.Couples.1.Users.1.name}}" />
        {% if errors.friendship.Couples.1.Users.1.notblank %}
        <label for="user_name" class="error">
            Vous devez entrer un Nom (au format: Prenom, Nom)
        </label>
        {% endif %}
    </p>
    <p>
        <label for="couple_login_email">Couriel</label>
        <input type="text" name="friendship[Couples][1][Users][1][login_email]" id="couple_login_email" value="{{friendship.Couples.1.Users.1.login_email}}" />
        {% if errors.friendship.Couples.1.Users.1.login_email.email %}
        <label for="user_name" class="error">
            Vous devez entrer un courriel valide
        </label>
        {% endif %}
        {% if errors.friendship.Couples.1.Users.1.login_email.unique %}
        <label for="user_name" class="error">
            Ce Courriel est d&eacute;j&agrave; pr&eacute;sent dans la base de donn&eacute;e
        </label>
        {% endif %}
    </p>
    <p>
        <label for="couple_tel1">T&eacute;l&eacute;phone</label>
        <input type="text" name="friendship[Couples][1][Users][1][tel1]" id="couple_tel1" value="{{friendship.Couples.1.Users.1.tel1}}" />
    </p>
    <p>
        <label for="couple_tel2">Cellulaire</label>
        <input type="text" name="friendship[Couples][1][Users][1][tel2]" id="couple_tel2" value="{{friendship.Couples.1.Users.1.tel2}}" />
    </p>
    <p>
        <label for="couple_address">Addresse</label>
        <textarea name="friendship[Couples][1][Users][1][address]" id="couple_address" >{{friendship.Couples.1.Users.1.address}}</textarea>
    </p>

    </fieldset>

    <h4> Si cela est possible je souhaiterais</h4>
    <fieldset>
        <p>
        <input type="checkbox" name="friendship[in_same_group]" id="friendship[in_same_group]" value="1" {% if friendship.in_same_group %} checked="checked" {% endif %}/> &ecirc;tre integr&eacute;gr&eacute;(e) au groupe dans lequel un(e) de mes amis est inscrit
        </p>
        <p>
        <input type="checkbox" name="friendship[sit_next_to]" id="friendship[sit_next_to]" value="1" {% if friendship.sit_next_to %} checked="checked" {% endif %}/> disposer ma table a cot&eacute; de la sienne
        </p>
        <p> * Pour cela la demande doit etre r&eacute;ciproque et la personne interess&eacute; doit &eacute;galement en faire la demande </p>
        <p> Veuillez indiquer son nom <input type="text" name="friendship[friend_name]" value="{{ friendship.friend_name }}"/></p>
    </fieldset>
    <fieldset>
        <p>
        <input type="radio" name="friendship[Couples][0][Users][0][second_time]" id="friendship.Couples.0.Users.0.second_time]" value="0" {% if !friendship.Couples.0.Users.0.second_time %} checked="checked" {% endif %}/> C'est la premiere fois que je participe au D&icirc;ner en Blanc
        </p>
        <p>
        <input type="radio" name="friendship[Couples][0][Users][0][second_time]" id="friendship[Couples][0][Users][0][second_time]" value="1" {% if friendship.Couples.0.Users.0.second_time %} checked="checked" {% endif %}/> J'ai particip&eacute; a l'&eacute;dition 2009 <br/>
        <label for="chief_2009">Dans le groupe de :</label><input type="text" name="friendship[Couples][0][Users][0][chief_2009]" value="{{friendship.Couples.0.Users.0.chief_2009}}"/> 
        <label for="host_2009">Invit&eacute; par : </label><input type="text" name="friendship[Couples][0][Users][0][host_2009]" value="{{friendship.Couples.0.Users.0.host_2009}}"/>
        </p>
        <p> Pour cet &eacute;v&eacute;nement chaque tabl&eacute;e doit apporter 2 chaises pliante blanche et une table car&eacute;e pliante. NB: Pour des questions de logistique nous sommesdans l'obligation de limiter la taille des tables. Taille autoris&eacute;e de 28 pouces &agrave; 32 pouces.</p>
        <p>
        <input type="radio" name="friendship[Couples][0][own_table]" id="friendship.Couples.0.own_table" value="1" {% if friendship.Couples.0.own_table %} checked="checked" {% endif %}/> Je possede d&eacute;j&agrave; l'&eacute;quipement n&eacute;cessaire ou me le procurerais de mon propre chef
        </p>
        <p>
        <input type="radio" name="friendship[Couples][0][own_table]" id="" value="0" {% if !friendship.Couples.0.own_table %} checked="checked" {% endif %}/> J'aimerais me procurer l'&eacute;quipement par le biais du s&icirc;te du D&icirc;ner en Blanc
        </p>
    </fieldset>
    <fieldset>
        <p>
        <input type="checkbox" name="alertme" id="alertme" value="yes" {% if alertme %} checked="checked" {% endif %}/> J'aimerais &eacute;galement &eacute;galement etre averti(e) des offres de paniers d&eacute;j&agrave; pr&eacute;par&eacute;s (nouriture et boisson) pour le soir de l'&eacute;v&eacute;nement. <strong>Ces offres seront disponibles sur le site web au mois de juillet</strong>

        </p>
    </fieldset>

    <p><label><input type="submit" name="submit" value="Envoyer"></label></p>
    </form>
    <script type="text/javascript" >
    $(function() { 
        {% if !friends %} $('#table2').hide(); {% endif %}
        $('#table2check').click(
            function(){$('#table2').toggle()}) 
        });

    </script>
{% endblock %}
