Решения задач
=============

Preamble
--------

1. Из данных таблицы tb_source не следует, что:
>>Один и тот же диагноз может быть выставлен пациенту только один раз.


MariaDB [test_vh]> select * from tb_source where ( MEDREC_ID,ICD ) in (select MEDREC_ID,ICD from tb_source group by MEDREC_ID , ICD having count(*)>1) order by MEDREC_ID;
+-----------+-------+------------------+
| MEDREC_ID | ICD   | PATIENT_NAME     |
+-----------+-------+------------------+
| 10439     | 13679 | Mason Mcconnell  |
| 10439     | 13679 | Mason Mcconnell  |
| 14892     | 90287 | Finley Valentine |
| 14892     | 90287 | Finley Valentine |
| 14936     | 4326  | Finley Eaton     |
| 14936     | 4326  | Finley Eaton     |
| 17639     | 22599 | Marion Hudson    |
| 17639     | 22599 | Marion Hudson    |
| 2068      | 31007 | Kris Gamble      |
| 2068      | 31007 | Kris Gamble      |
| 21817     | 69762 | Dana Cross       |
| 21817     | 69762 | Dana Cross       |
| 25596     | 21465 | Ollie Cohen      |
| 25596     | 21465 | Ollie Cohen      |
| 27567     | 12626 | Keegan Shah      |
| 27567     | 12626 | Keegan Shah      |
| 32568     | 65912 | Scout Rowland    |
| 32568     | 65912 | Scout Rowland    |
| 42776     | 34137 | Sam Huerta       |
| 42776     | 34137 | Sam Huerta       |
| 47075     | 65802 | Lane Cooper      |
| 47075     | 65802 | Lane Cooper      |
| 53201     | 26455 | Kelsey Cuevas    |
| 53201     | 26455 | Kelsey Cuevas    |
| 53914     | 23935 | Peyton Gould     |
| 53914     | 23935 | Peyton Gould     |
| 54465     | 24737 | Jayden Moss      |
| 54465     | 24737 | Jayden Moss      |
| 56050     | 30242 | Brett Li         |
| 56050     | 30242 | Brett Li         |
| 64221     | 4737  | River Ochoa      |
| 64221     | 4737  | River Ochoa      |
| 66621     | 3889  | Kerry Kemp       |
| 66621     | 3889  | Kerry Kemp       |
| 77834     | 80562 | Chris Burnett    |
| 77834     | 80562 | Chris Burnett    |
| 78081     | 64306 | Skyler Ali       |
| 78081     | 64306 | Skyler Ali       |
| 80009     | 33999 | Ollie Arnold     |
| 80009     | 33999 | Ollie Arnold     |
| 85383     | 75731 | Taylor Spence    |
| 85383     | 75731 | Taylor Spence    |
| 91421     | 7660  | Harper Barr      |
| 91421     | 7660  | Harper Barr      |
| 93459     | 61559 | Sam Curry        |
| 93459     | 61559 | Sam Curry        |
| 9990      | 51527 | Addison Myers    |
| 9990      | 51527 | Addison Myers    |
+-----------+-------+------------------+


2. Сделаем индексы

MariaDB [test_vh]> create  index i1 on tb_source(MEDREC_ID,ICD);
MariaDB [test_vh]> create  index i1 on tb_rel(MEDREC_ID, NDC);


Task #1
-------

MariaDB [test_vh]> select distinct s.MEDREC_ID, s.PATIENT_NAME from tb_source s, tb_rel r where s.MEDREC_ID=r.MEDREC_ID and PATIENT_NAME like binary '%Alex%' order by s.PATIENT_NAME;
+-----------+--------------------+
| MEDREC_ID | PATIENT_NAME       |
+-----------+--------------------+
| 2040      | Alex Barr          |
| 2919      | Alex Becker        |
| 3104      | Alex Benson        |
| 2585      | Alex Bentley       |
| 1946      | Alex Berg          |
| 5159      | Alex Blackburn     |
| 3771      | Alex Blevins       |
| 3035      | Alex Booker        |
| 366       | Alex Boone         |
| 1665      | Alex Boyle         |
| 3737      | Alex Bridges       |
| 9917      | Alex Briggs        |
| 6647      | Alex Brooks        |
| 1345      | Alex Bryan         |
| 4768      | Alex Buchanan      |
| 1628      | Alex Burke         |
| 6051      | Alex Byrd          |
| 1961      | Alex Cannon        |
| 8091      | Alex Carlson       |
| 6956      | Alex Carrillo      |
| 6500      | Alex Carrillo      |
| 9108      | Alex Chambers      |
| 8563      | Alex Chen          |
| 2901      | Alex Contreras     |
| 5205      | Alex Cooke         |
| 953       | Alex Curry         |
| 3595      | Alex Daniel        |
| 5724      | Alex Donovan       |
| 3484      | Alex Duke          |
| 184       | Alex Erickson      |
| 9748      | Alex Fernandez     |
| 2948      | Alex Fisher        |
| 9904      | Alex Fisher        |
| 4154      | Alex Francis       |
| 5382      | Alex Frederick     |
| 4364      | Alex Friedman      |
| 4894      | Alex Griffith      |
| 990       | Alex Harrison      |
| 9562      | Alex Hayden        |
| 4204      | Alex Hayes         |
| 1887      | Alex Hays          |
| 3678      | Alex Henry         |
| 943       | Alex Hines         |
| 2185      | Alex Hughes        |
| 4456      | Alex Hughes        |
| 3231      | Alex Joyce         |
| 822       | Alex Leach         |
| 1678      | Alex Levy          |
| 4033      | Alex Levy          |
| 6332      | Alex Livingston    |
| 1331      | Alex Mack          |
| 8028      | Alex Malone        |
| 5550      | Alex Martin        |
| 2010      | Alex May           |
| 5162      | Alex Mccall        |
| 6133      | Alex Mccarthy      |
| 9277      | Alex Mcclain       |
| 4829      | Alex Mcknight      |
| 7817      | Alex Mcmillan      |
| 9567      | Alex Medina        |
| 7484      | Alex Mullen        |
| 164       | Alex Munoz         |
| 1704      | Alex Murphy        |
| 6522      | Alex Ortega        |
| 2036      | Alex Patrick       |
| 8237      | Alex Perez         |
| 1584      | Alex Pitts         |
| 9690      | Alex Porter        |
| 6625      | Alex Pruitt        |
| 4797      | Alex Ramirez       |
| 6504      | Alex Ramsey        |
| 3100      | Alex Rasmussen     |
| 8423      | Alex Rivas         |
| 4594      | Alex Salinas       |
| 6482      | Alex Schultz       |
| 5547      | Alex Solomon       |
| 6410      | Alex Todd          |
| 2417      | Alex Tyler         |
| 4699      | Alex Villarreal    |
| 8598      | Alex Walter        |
| 1643      | Alex Werner        |
| 4104      | Alex Wiley         |
| 8258      | Alex Wilson        |
| 2946      | Alex Wilson        |
| 5521      | Alex Wolf          |
| 9328      | Alex Wong          |
| 3798      | Alex Wyatt         |
| 169       | Alex Yang          |
| 5186      | Alex Young         |
| 210       | Alex Yu            |
| 2660      | Alex Zamora        |
| 8460      | Alexis Alexander   |
| 6678      | Alexis Ashley      |
| 4662      | Alexis Ashley      |
| 9733      | Alexis Avery       |
| 2921      | Alexis Bailey      |
| 7560      | Alexis Beasley     |
| 3557      | Alexis Beck        |
| 1142      | Alexis Bell        |
| 2780      | Alexis Bernard     |
| 1534      | Alexis Bishop      |
| 6243      | Alexis Blankenship |
| 7023      | Alexis Bond        |
| 3921      | Alexis Bowers      |
| 2110      | Alexis Bruce       |
| 4979      | Alexis Campos      |
| 5138      | Alexis Carpenter   |
| 9574      | Alexis Castillo    |
| 6726      | Alexis Clarke      |
| 6792      | Alexis Cochran     |
| 1956      | Alexis Coffey      |
| 7377      | Alexis Coffey      |
| 7768      | Alexis Donovan     |
| 305       | Alexis Estes       |
| 3623      | Alexis Evans       |
| 3815      | Alexis Farley      |
| 9348      | Alexis Fleming     |
| 566       | Alexis Foster      |
| 1826      | Alexis Foster      |
| 4799      | Alexis Fritz       |
| 3512      | Alexis Gibson      |
| 3626      | Alexis Gillespie   |
| 5437      | Alexis Gonzalez    |
| 3657      | Alexis Gray        |
| 3999      | Alexis Harrell     |
| 3763      | Alexis Herrera     |
| 7936      | Alexis Hickman     |
| 5692      | Alexis Hodge       |
| 3235      | Alexis Holland     |
| 3065      | Alexis Howard      |
| 6706      | Alexis Huerta      |
| 7081      | Alexis Lamb        |
| 8173      | Alexis Lee         |
| 4572      | Alexis Leonard     |
| 7989      | Alexis Macias      |
| 194       | Alexis Maddox      |
| 519       | Alexis Martin      |
| 7845      | Alexis Martinez    |
| 4616      | Alexis Mason       |
| 7999      | Alexis Mayo        |
| 4642      | Alexis Mccormick   |
| 1478      | Alexis Miles       |
| 3784      | Alexis Moran       |
| 7751      | Alexis Morse       |
| 4217      | Alexis Morse       |
| 898       | Alexis Navarro     |
| 8282      | Alexis Navarro     |
| 6234      | Alexis Noble       |
| 281       | Alexis Oconnor     |
| 2383      | Alexis Odom        |
| 8616      | Alexis Park        |
| 8290      | Alexis Parker      |
| 6977      | Alexis Pope        |
| 9258      | Alexis Potts       |
| 7628      | Alexis Preston     |
| 8405      | Alexis Prince      |
| 2826      | Alexis Ray         |
| 7324      | Alexis Reed        |
| 1850      | Alexis Rhodes      |
| 2563      | Alexis Riley       |
| 782       | Alexis Riley       |
| 2920      | Alexis Rush        |
| 2858      | Alexis Sanford     |
| 1749      | Alexis Sawyer      |
| 3320      | Alexis Schaefer    |
| 7477      | Alexis Serrano     |
| 9539      | Alexis Stevens     |
| 4460      | Alexis Trujillo    |
| 7388      | Alexis Vance       |
| 7110      | Alexis Vang        |
| 2443      | Alexis Velasquez   |
| 7203      | Alexis Velazquez   |
| 7704      | Alexis Villarreal  |
| 7647      | Alexis Walter      |
| 8096      | Alexis Wang        |
| 5224      | Alexis Ward        |
| 3213      | Alexis Watson      |
| 9225      | Alexis Weiss       |
| 310       | Alexis Werner      |
| 4146      | Alexis Wheeler     |
| 4305      | Alexis Wiggins     |
| 8379      | Alexis Wright      |
| 8147      | Alexis York        |
| 4238      | Ashton Alexander   |
| 367       | Hayden Alexander   |
| 9405      | Keegan Alexander   |
| 752       | Keegan Alexander   |
| 6397      | Madison Alexander  |
| 232       | Ryan Alexander     |
| 4792      | Scout Alexander    |
+-----------+--------------------+


Task #2
-------

MariaDB [test_vh]> select count(*) from (select 1 from tb_rel group by MEDREC_ID , NDC having count(*)>2) t1;
+----------+
| count(*) |
+----------+
|      338 |
+----------+