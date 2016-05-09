# lolrpg

LOLRPG has been designed as a submission for the April/May 2016 Riot Games API challenge.

# Philosophy

We wanted to build LOLRPG using nothing but native browser functionality. Not only this, but we also wanted LOLRPG to
be built using html for display rather than using a canvas element. This choice was made in order to make LOLRPG as
accessible as possible through nearly any device that supports html.

We wanted LOLRPG to maintain as much of the spirit or essence of League of Legends as possible, and hopefully
anyone who has played League of Legends and plays LOLRPG will feel right at home there. Our interface was designed to
mimic League of Legend's own, with a twist of it's own personality in order to adhere to it's requirements.

Finally we wanted to make sure that LOLRPG was accessible to not just League of Legends regular players, but anyone who
wanted to try it. LOLRPG's 'Use Free To Play Champion' option allows anyone, even those who do not have (or do not know)
a summoner name, to play LOLRPG. Meanwhile we also wanted to improve and expand a user's experience within LOLRPG based
on their summoner mastery stats in League of Legends.

# Server Requirements

LOLRPG is currently hosted at http://lolrpg.lol. Anyone however can host LOLRPG themselves with the source code found in
this repository. In order to use the code as is, the server will need to have these configurations:

Apache 2 with Mod Rewrite turned on

PHP 5.4+ with cURL

That's it. LOLRPG is a mostly client based application and the only client/server interactions are used to make requests
from the League of Legends API.

In addition to these server requirements, there are a few other setup considerations to make when hosting LOLRPG. First
and foremost is that the API key used to make requests from the League of Legends API services is *NOT* included in this
repository. The file config/api_key.php.tmp holds then instructions on how to set up the API key for the server. Finally
the social portion (Facebook Sharing/Liking, and Twitter Tweeting) will not work correctly unless the instances of "lolrpg.lol"
are replaced with the new domain name that the site will be hosted under. It would be highly recommended to create a facebook
developer account for the new domain as well.

# Gameplay

This is a very quick rundown of the the game is played. Check the in game "Game Guide" for a more detailed version.

LOLRPG allows users to either sign in with a valid summoner's name or use any of the currently available free to play
champions. Once signed in, a summoner can switch to the free to play champion list if they wish to.

Player champion mastery bonuses are based on the signed in summoners overall champion mastery and specific champion mastery. A
user who did not sign in will receive no champion mastery bonuses.

After selecting a champion the user will then need to choose which difficulty level they wish to play LOLRPG at. The suggested
difficulty (based on their champion mastery overall bonus) will be preselected. Each difficulty is targeted at summoners with
varying amounts of overall bonuses and should provide challenges for even the most seasoned of League of Legends summoners.

Upon choosing a difficulty the user will then begin the match. The match is broken up into two phase, the lane phase and
the battle phase.

Games will begin in the lane phase where the user can choose to either farm minions, or push their lane.

# Farming Minions

The player will roam the lane and engage a battle against a randomly generated minion (at higher difficulties there is a
chance that the player will be ambushed by the enemy jungler).

Minions do not have special attack and are generally weak. Beware of cannon minions though, as they can do significant damage
to all but the tankiest of champions.

Killing minions grant a small amount of experience, and taking the time to farm can allow the player to regenerate some
health and lower their cooldowns in preparation for a champion battle.

# Pushing the Lane

The player will surge forth in their lane, engaging the next enemy champion they come to.

Enemy champions are very similar to the player's champion. They have an ability with the same cooldown as the player (though
they do not have a heal). These battle can be very difficult and it is recommended that the player has their heal off (or nearly)
cooldown before engaging.

Enemy champions grant a large amount of experience, which increases for every enemy champion kill past the first.

# Player Leveling

As the player kills minions and enemy champions they will gain levels. With new level attained the player will earn an
attribute point. These can be spent to increase any of the six base stats (attack damage, ability damage, critical chance,
health regen, armor, or health). The amount a stat is increased is based on the player's overall mastery bonus and a base
value for the attribute points.

# Match Victory / Defeat

The player wins the match by defeating the 5 opposing enemy champions.

The player loses if they die.

You have one life to give, use it wisely.

# Final Notes

There were many features that we wanted, but did not have the time to get them into the game. That being said, we are happy
with our results and hope you enjoy the game! Please do not hesitate to contact us about anything regarding LOLRPG.

George (Cole) Millsap (cole@cole-designs.com)

Andrew Watts (wattsandrew017@gmail.com)