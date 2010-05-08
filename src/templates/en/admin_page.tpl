{% extends "organisation_base.tpl" %}

{% block action_list %}
    <li><a href="/user/inviter/{{user.id}}">My Guests</a> </li>
    <li><a href="http://mail.google.com">Emails</a> </li>
    {% if user.id == 1 %}
    <li><a href="/organisateur/2">Bobby</a></li>
    {% endif %}
    {% if user.id == 2 %}
    <li><a href="/organisateur/1">Aymeric</a></li>
    {% endif %}
    <li><a href="/organisateur/edit/{{user.id}}">Edit</a></li>
{% endblock %}

{% block column_left %}
    <h3>Contact</h3>
    {% include 'snipp/user_info.tpl' %}
    <h3>Notes</h3>
    <form name="note" id="note" action="/note/edit" method="post">
        <p><label for="">Note about
            <select name="type" id="note_type" onChange="get_note();">
            <option value="bus">Bus</option>
            <option value="groupes">Groups</option>
            </select></label>
        </p>
        <p><textarea name="content" id="note_content"></textarea></p>
        <p><input type="submit" value="Save"/></p>
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
    <h3>Email</h3>
    <form name="email" id="email" action="/email/all" method="post">
        <p>Email to all guests</p>
        <p><label for="email_subject">Subject:</label><input type="text" name="email_subject" id="email_subject"/></p>
        <p><label for="email_body">Content:</label><textarea name="email_body"></textarea></p>
        <p><label for="attachement">Attach a File</label><input type="file" name="attachement" id="attachement" /> </p>
        <p><input type="reset" value="Cancel"/><input name="submit" type="submit" value="Send"/></p>
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
    <h3>Counters</h3>
        <p class="data_row" ><span for="nb_place">Event places nb. :</span> <span class="data_box {{user.type|slug_title}}" >{{config.nb_places}}</span></p>
        <p class="data_row" ><span for="vacant">To distribute :</span> <span class="data_box {{user.type|slug_title}}" >{{config.a_envoyer}}</span></p>
        <p class="data_row" ><span for="confirmed">Confirmed :</span> <span class="data_box {{user.type|slug_title}}" >{{config.nb_confirmes}}</span></p>
        <p class="data_row" ><span for="available">Available :</span> <span class="data_box {{user.type|slug_title}}" >{{config.nb_dispo}}</span></p>
    <h3>Finances</h3>
    {{finances|safe}}
{% endblock %}

{% block no_column %}
        <select id="sel_list"><option selected="selected">Groups</option><option>Bus</option></select>
    <div id="group_list" class="toggle">
        {% include 'snipp/group_list.tpl' %}
        <a href="/group/add">add a group</a>
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
