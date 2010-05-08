{% extends "organisation_base.tpl" %}

{% block action_list %}
    <li> <a href="/bus/{{main_bus_id}}">My Bus</a></li>
    <li><a href="/user/inviter/{{user.id}}">My Guests</a> </li>
    <li><a href="/group/edit/{{group.id}}">Edit</a></li>
{% endblock %}

{% block column_left %}
    <h3>Contact</h3>
    {% include 'snipp/user_info.tpl' %}
{% endblock %}

{% block column_right %}
    <h3>Counters</h3>
    <form>
        <p class="data_row">
            <span class="legend">Bus number</span>
            <span class="data_box {{user.type|slug_title}}">{{compteurs.bus}}</span>
        </p>
        <p class="data_row">
            <span class="legend">Places in Group</span>
            <span class="data_box {{user.type|slug_title}}">{{compteurs.places}}</span>
        </p>
        <p class="data_row">
            <span class="legend">Confirmed</span>
            <span class="data_box {{user.type|slug_title}}">{{compteurs.confirmes}}</span>
        </p>
        <p class="data_row">
            <span class="legend">Available</span>
            <span class="data_box {{user.type|slug_title}}">{{compteurs.disponibles}}</span>
        </p>
    </form>
{% endblock %}

{% block no_column %}
    <h3>My Group</h3>
    {% include 'snipp/bus_list.tpl' %}
    <a href="/bus/add/{{group.id}}">add a bus</a>
    <h3>Notes</h3>
    <form name="note" id="note" action="/note/edit/{{user.id}}" method="post">
        <p><label for="note_content">Note about the group </label></p>
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
    <form name="email" id="email" action="/email/group/{{group.id}}" method="post">
        <p>Email to my Group's Guests</p>
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
