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

