{% extends "organisation_base.tpl" %}

{% block content %}
    <div id="page">
    <div id="sub_header">
    <span class="ariane">{{user.name}}</span>
        <ul class="sub_menu right">
        <li> <a href="">Mon Bus</a></li>
        <li><a href="">Mes Invites</a> </li>
        <li><a href="">Site Web</a> </li>
        <li><a href="">Courriels</a> </li>
        <li><a href="">Bobby</a></li>
        </ul>
    </div>
    <div style="clear:both"></div>
    <div id="column_left">
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
                <form name="email" id="email" action="/email/send" method="post">
                    <p><label for="radio_to">Ecrire a 
                        <select name="radio_to">
                            <option value="radio_allusers">Tous les invites</option>
                            <option value="radio_allgroupchiefs">Tous les Chefs de Groupe</option>
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
    </div>
    <div id="column_right">
                <h3>Compteur</h3>
                <form>
                    <p><label for="nb_place">Nombres de places &eacute;v&eacute;nement:</label><input type="text" value="Nom, Prenom" /></p>
                    <p><label for="vacant">A distribuer:</label><input type="text" value="Courriel" /></p>
                    <p><label for="confirmed">Confirmes:</label><input type="text" value="Telephone 1" /></p>
                    <p><label for="available">Disponibles:</label><input type="text" value="Telephone 2" /></p>
                </form>
                <h3>Finances</h3>
    </div>
    <div style="clear:both"></div>
    <div>
                <select><option>Groupes</option><option>Bus</option></select>
                {% include 'snipp/group_list.tpl' %}
                <a href="/group/add">ajouter un groupe</a>
    </div>
    </div>
{% endblock %}
