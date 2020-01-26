FROM mongo

COPY ./*.json /seed/

CMD mongoimport --host mongo --db ultimaphp --collection accounts --type json --file /seed/accounts.json \
&&  mongoimport --host mongo --db ultimaphp --collection players --type json --file /seed/players.json \
&&  mongoimport --host mongo --db ultimaphp --collection server_starting_locations --type json --file /seed/server_starting_locations.json \
&&  mongoimport --host mongo --db ultimaphp --collection objects --type json --file /seed/objects.json