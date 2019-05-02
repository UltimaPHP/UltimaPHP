FROM mongo

COPY ./*.json /seed/

CMD mongoimport --host mongo --db ultimaphp --collection accounts --type json --file /seed/accounts.json \
&&  mongoimport --host mongo --db ultimaphp --collection players --type json --file /seed/players.json \
&&  mongoimport --host mongo --db ultimaphp --collection server_starting_locations --type json --file /seed/server_starting_locations.json \
&&  mongoimport --host mongo --db ultimaphp --collection objects --type json --file /seed/objects.json \
&&  mongoimport --host mongo --db ultimaphp --collection regions --type json --file /seed/regions.json \
&&  mongoimport --host mongo --db ultimaphp --collection felucca_locations --type json --file /seed/felucca_locations.json \
&&  mongoimport --host mongo --db ultimaphp --collection trammel_locations --type json --file /seed/trammel_locations.json \
&&  mongoimport --host mongo --db ultimaphp --collection ilshenar_locations --type json --file /seed/ilshenar_locations.json \
&&  mongoimport --host mongo --db ultimaphp --collection malas_locations --type json --file /seed/malas_locations.json \
&&  mongoimport --host mongo --db ultimaphp --collection tokuno_locations --type json --file /seed/tokuno_locations.json 