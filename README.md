Mikrotik is not taking the Delegated-IPv6-Prefix attribute when you use PPPoE and Radius.
In some countries is mandatory to save this info.

I was able to do a dirty fix using a script in the Mikrotik, a php web page on the freeradius, and some changes in queries.conf of freeradius 3.

The idea is to save the PD in the attribute of the radreply table named Delegated-IPv6-Prefix , (I know should be used in the other way).
And later, when the Mikrotik do the accounting, uodate the Delegated-IPv6-Prefix in the radacct table.

You must have mysql, a web server (tested in apache2), and php whith PDO support.

The Mikrotik Script should be placed in the PPPoE Profile, script section.

The php update-ipv6.php file in the same location you put in the fetch section in the Mikrotik Script.

And you must add this code to /etc/freeradius/3.0/mods-config/sql/main/mysql/queries.conf

in the interim-update section, query, before the WHERE line.
 
[code]
delegatedipv6prefix = (select value from radreply where attribute='Delegated-IPv6-Prefix' and username='%{SQL-User-Name}') \
[/code]

You need to have added the Delegated-IPv6-Prefix attribute to radreply, and save a valid IPv6 Address, if not, the freeradius will not start.


I hope this can be usefull for someone.

Demian
