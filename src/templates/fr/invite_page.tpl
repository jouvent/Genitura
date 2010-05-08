{% extends "organisation_base.tpl" %}

{% block action_list %}
    <li>{{user.invite_status|status|safe}}</li>
    <li><a href="/invite/edit/{{user.id}}">&Eacute;diter</a></li>
{% endblock %}

{% block column_left %}
    <h3>Ma Table</h3>
    {% include 'snipp/user_info.tpl' %}
    <h4><a href="/user/page/{{in_couple.id}}">{{in_couple.name}}</a></h4>

    <p>Poss&egrave;dent leur propre equipement: {{couple.own_table|bool}}<br/>
    Commande: {{basket_simple.table}} Tables, {{basket_simple.chair}} Chaises, {{basket_simple.basket}} Paniers</p>
    {% if couple.own_table %}
    {% else %}
    <p><a href="/purchase">Commander des tables et des chaises</a></p>
    {% endif %}

    {% if has_friends %}
    <h3>Autre Table</h3>
    <h4><a href="/user/page/{{friend_1.id}}">{{friend_1.name}}</a></h4>
    <h4><a href="/user/page/{{friend_2.id}}">{{friend_2.name}}</a></h4>

    <p>Poss&egrave;dent leur propre equipement: {{friends.own_table|bool}}<br/>
    Commande: {{friend_basket_simple.table}} Tables, {{friend_basket_simple.chair}} Chaises, {{friend_basket_simple.basket}} Paniers</p>

    {% endif %}
{% endblock %}

{% block column_right %}
    <h3>Compteur</h3>
    <form>
        <p class="data_row">
            <span class="legend">Chef de Groupe</span>
            <span class="data_box {{user.type|slug_title}}">{{group_chief.name}}</span>
        </p>
        <p class="data_row">
            <span class="legend">Chef de Bus</span>
            <span class="data_box {{user.type|slug_title}}">{{bus_chief.name}}</span>
        </p>
        <p class="data_row">
            <span class="legend">Provenance</span>
            <span class="data_box {{user.type|slug_title}}">{% if inviter == 'prev' %} DEB 2009 {% else %}{{inviter.name}}{% endif %}</span>
        </p>
        <p class="data_row">
            <span class="legend">Veut &ecirc;tre assis &aacute; c&ocirc;t&eacute; de</span>
            <span class="data_box {{user.type|slug_title}}">{{user.sit_next_to}}</span>
        </p>
        <h3>Invit&eacute; Payeur</h3>
    <p class="data_row">
        <span class="legend">Nom</span>
        <span class="data_box {{user.type|slug_title}}" >{{inv_pay.sex|gender}} {{inv_pay.name}}</span>
    </p>
    <p class="data_row">
        <span class="legend">Couriel</span>
        <span class="data_box {{user.type|slug_title}}" >{{inv_pay.login_email}}</span>
    </p>
    <p class="data_row">
        <span class="legend">T&eacute;l&eacute;phone</span>
        <span class="data_box {{user.type|slug_title}}" >{{inv_pay.tel1}}</span>
    </p>
    <p class="data_row">
        <span class="legend">Cellulaire</span>
        <span class="data_box {{user.type|slug_title}}" >{{inv_pay.tel2}}</span>
    </p>
    <p class="data_row">
        <span class="legend">Adresse</span>
        <span class="data_box {{user.type|slug_title}}" >{{inv_pay.address}}</span>
    </p>
    </form>

    <h3>Ecrire</h3>
    <form name="email" id="email" action="/email/all" method="post">
        <p>Ecrire &agrave; Tous les invites</p>
        <p><label for="email_subject">Sujet:</label><input type="text" name="email_subject" id="email_subject"/></p>
        <p><label for="email_body">Contenu:</label><textarea name="email_body"></textarea></p>
        <p><label for="attachement">Joindre un fichier</label><input type="file" name="attachement" id="attachement" /> </p>
        <p><input type="reset" value="Effacer"/><input name="submit" type="submit" value="Envoyer"/></p>
    </form>
    <script type="text/javascript">
        $(document).ready(function() {
            // handle form submit in javascript
            $('#email').ajaxForm(function() {
                alert("Email sent!");
            });
        });
    </script>
{% endblock %}

{% block no_column %}
    {% if logged.type == 'A' %}
    <h3>Sommaire Panier</h3>
    {{basket|safe}}
    {% endif %}
{% endblock %}





{% block __content %}
    <div id="page" class="bus_border">
    <div id="sub_header" class="bus">
    <span class="ariane"><a href="/group/{{group.id}}">{{group_chief.name}}</a> - <a href="">{{user.name}}</a></span>
        <ul class="sub_menu right">
        <li><a href="/bus/{{main_bus_id}}">Mon Bus</a></li>
        <li><a href="">Mes Invites</a></li>
        <li><a href="">Site Web</a></li>
        <li><a href="">Courriels</a></li>
        <li><a href="">Bobby</a></li>
        </ul>
    </div>
    <div style="clear:both"></div>
    <div id="column_left">
                <h3>Contact</h3>
                {% include 'snipp/user_info.tpl' %}
    </div>
    <div id="column_right">
                <h3>Compteur</h3>
                <form>
                    <p><label for="nb_place">Nombres de Bus</label><input type="text" value="{{compteurs.bus}}" /></p>
                    <p><label for="vacant">Nombre de places - Groupe</label><input type="text" value="{{compteurs.places}}" /></p>
                    <p><label for="confirmed">Confirmes</label><input type="text" value="{{compteurs.confirmes}}" /></p>
                    <p><label for="available">Disponibles</label><input type="text" value="{{compteurs.disponibles}}" /></p>
                </form>
    </div>
    <div style="clear:both"></div>
    <div>
                <h3>Mon Groupe</h3>
                {% include 'snipp/couple_list.tpl' %}
                <h3>Notes</h3>
                <form name="note" id="note" action="/note/edit/{{user.id}}" method="post">
                    <p><label for="note_content">Note au sujet du groupe </label></p>
                    <p><textarea name="content" id="note_content"></textarea></p>
                    <p><input type="submit" value="Sauvegarder"/></p>
                    <input type="hidden" name="user" value="{{user.id}}" />
                </form>
                <script type="text/javascript">
                    $(document).ready(function() {
                        // handle form submit in javascript
                        $('#note').ajaxForm(function() {
                            alert("Note saved !");
                        });
                    });
                    // get the note by type
                    function get_note(){
                        $.getJSON('/admin/notes.php?type='+$('#note_type').val(),function(data){$('#note_content').val(data.content);})
                    }
                </script>
                <h3>Ecrire</h3>
                <form name="email" id="email" action="/email/send" method="post">
                    <p><label for="radio_to">Ecrire a
                        <select name="radio_to">
                            <option value="radio_allusers">Tous les invites</option>
                            <option value="radio_allchiefs">Tous les Chefs de Bus</option>
                        </select></label>
                    </p>
                    <p><label for="email_subject">Sujet:</label><input type="text" name="email_subject" id="email_subject"/></p>
                    <p><label for="email_body">Contenu:</label><textarea name="email_body"></textarea></p>
                    <p><input type="reset" value="Effacer"/><input name="submit" type="submit" value="Envoyer"/></p>
                </form>
                <script type="text/javascript">
                    $(document).ready(function() {
                        // handle form submit in javascript
                        $('#email').ajaxForm(function() {
                            alert("Email sent!");
                        });
                    });
                </script>
                <h3>Sommaire Panier</h3>
                {{basket|safe}}
    </div>
    </div>
{% endblock %}
