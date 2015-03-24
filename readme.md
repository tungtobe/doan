#I. Setup Project

###Step1: Setup database

Create database name `pgtest10`

```
mysql> create database pgtest10;
```
create database username `pgtest10` and password `b9@o9yqUX`

Import sql file in `schema/pgtest10.sql`

```
$ mysql -upgtest10 -pb9@o9yqUX pgtest10 < pgtest10.sql
```

if you want to use your own database, edit config in `app/config/database`
###Step2: setup a virtual host
setup a virtual host name `local.host`

Ubuntu: [link](https://www.digitalocean.com/community/tutorials/how-to-set-up-apache-virtual-hosts-on-ubuntu-14-04-lts)

MacOS: [link](http://coolestguidesontheplanet.com/set-virtual-hosts-apache-mac-osx-10-9-mavericks-osx-10-8-mountain-lion/)

###Step3: Download source code to your server document root folder

Clone source code 

```
$ git clone https://github.com/tungtobe/aproject.git
```

##Some Project Images
####Home page

![home1](http://i275.photobucket.com/albums/jj288/tung_tobe/Flush%20Video/index.png)
![home1](http://i275.photobucket.com/albums/jj288/tung_tobe/Flush%20Video/index_login.png)

##### Invalid video type

![valid](http://i275.photobucket.com/albums/jj288/tung_tobe/Flush%20Video/file_type.png)

#### Video page
![video](http://i275.photobucket.com/albums/jj288/tung_tobe/Flush%20Video/video_detail.png)

#### Share function

![share](http://i275.photobucket.com/albums/jj288/tung_tobe/Flush%20Video/share.png)

#### Comment function

![comment](http://i275.photobucket.com/albums/jj288/tung_tobe/Flush%20Video/comment.png)

#### Video setting
![setting](http://i275.photobucket.com/albums/jj288/tung_tobe/Flush%20Video/video_edit.png)


