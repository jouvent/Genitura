{% extends "organisation_base.tpl" %}

{% block action_list %}
    <li> <a href="/bus/{{main_bus_id}}">Mon Bus</a></li>
    <li><a href="/user/inviter/{{user.id}}">Mes Invites</a> </li>
    <li><a href="/group/edit/{{group.id}}">&Eacute;diter</a></li>
{% endblock %}

{% block column_left %}
    <h3>Contact</h3>
    {% include 'snipp/user_info.tpl' %}
{% endblock %}

{% block column_right %}
    <h3>Compteur</h3>
    <form>
        <p class="data_row">
            <span class="legend">Nombres de Bus</span>
            <span class="data_box {{user.type|slug_title}}">{{compteurs.bus}}</span>
        </p>
        <p class="data_row">
            <span class="legend">Nb. de places - Groupe</span>
            <span class="data_box {{user.type|slug_title}}">{{compteurs.places}}</span>
        </p>
        <p class="data_row">
            <span class="legend">Confirmes</span>
            <span class="data_box {{user.type|slug_title}}">{{compteurs.confirmes}}</span>
        </p>
        <p class="data_row">
            <span class="legend">Disponibles</span>
            <span class="data_box {{user.type|slug_title}}">{{compteurs.disponibles}}</span>
        </p>
    </form>
{% endblock %}

{% block no_column %}
    <h3>Mon Groupe</h3>
    {% include 'snipp/bus_list.tpl' %}
    <a href="/bus/add/{{group.id}}">ajouter un bus</a>
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
    <form name="email" id="email" action="/email/group/{{group.id}}" method="post">
        <p>Ecrire aux invit&eacute;s de mon Groupe </p>
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
