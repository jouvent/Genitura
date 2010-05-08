{% extends "organisation_base.tpl" %}

{% block action_list %}
    <li><a href="/user/inviter/{{user.id}}">Mes Invit&eacute;s</a> </li>
    <li><a href="http://mail.google.com">Courriels</a> </li>
    {% if user.id == 1 %}
    <li><a href="/organisateur/2">Bobby</a></li>
    {% endif %}
    {% if user.id == 2 %}
    <li><a href="/organisateur/1">Aymeric</a></li>
    {% endif %}
    <li><a href="/organisateur/edit/{{user.id}}">&Eacute;diter</a></li>
{% endblock %}

{% block column_left %}
    <h3>Contact</h3>
    {% include 'snipp/user_info.tpl' %}
    <h3>Notes</h3>
    <form name="note" id="note" action="/note/edit" method="post">
        <p><label for="">Note au sujet des
            <select name="type" id="note_type" onChange="get_note();">
            <option value="bus">Bus</option>
            <option value="groupes">Groupes</option>
            </select></label>
        </p>
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
    <form enctype="multipart/form-data" name="email" id="email" action="/email/all" method="post">
        <p>Ecrire &agrave; Tous les invites</p>
        <p><label for="email_subject">Sujet:</label><input type="text" name="email_subject" id="email_subject"/></p>
        <p><label for="email_body">Contenu:</label><textarea name="email_body"></textarea></p>
        <p><label for="attachement">Joindre un fichier</label><input type="file" name="attachement" id="attachement" /> </p>
        <p><input type="reset" value="Effacer"/><input name="submit" type="submit" value="Envoyer"/></p>
<script type= "text/javascript">
$(document).ready(function(){
    new AjaxUpload('#button3', {
        //action: 'upload.php',
        action: 'upload.htm', // I disabled uploads in this example for security reaaons
        name: 'myfile',
        onComplete : function(file){
            $('<li></li>').appendTo($('#example3 .files')).text(file);
        }
    });
});
</script>

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

{% block column_right %}
    <h3>Compteur</h3>
        <p class="data_row" ><span for="nb_place">Nb. de places &eacute;v&eacute;nement:</span><span class="data_box {{user.type|slug_title}}" >{{config.nb_places}}</span></p>
        <p class="data_row" ><span for="vacant">A distribuer:</span><span class="data_box {{user.type|slug_title}}" >{{config.a_envoyer}}</span></p>
        <p class="data_row" ><span for="confirmed">Confirmes:</span><span class="data_box {{user.type|slug_title}}" >{{config.nb_confirmes}}</span></p>
        <p class="data_row" ><span for="available">Disponibles:</span><span class="data_box {{user.type|slug_title}}" >{{config.nb_dispo}}</span></p>
    <h3>Finances</h3>
    {{finances|safe}}
{% endblock %}

{% block no_column %}
        <select id="sel_list"><option selected="selected">Groupes</option><option>Bus</option></select>
    <div id="group_list" class="toggle">
        {% include 'snipp/group_list.tpl' %}
        <a href="/group/add">ajouter un groupe</a>
    </div>
    <div id="bus_list" class="toggle" style="display:none;">
        {% include 'snipp/bus_list.tpl' %}
    </div>
    <script>
     $(document).ready(function() { 
     $('#sel_list').change(function(){
         $('.toggle').toggle();
     })});
    </script>
{% endblock %}
