# Doral Education System
## To-Do:
* **Answering 'When is it?':**
    * ***Resources:***
        * ['Normal Day' Doral Schedule](https://www.doralacademyprep.org/pdf/BELL_SCHEDULE_UPDATED_9-5-2019.pdf)
        * ['Short Day' Doral Schedule](https://www.doralacademyprep.org/apps/bell_schedules/)
    * ***Suggestions:***
        * Use an SQL table named `days` or something better and have the following information for each of the school days:
            * `date [Type: DATE; Ex. '2020-04-16']`
            * `type [Type: VARCHAR(2); 'N' or 'S']`
            * `day (or a better name)  [Type: VARCHAR(1); 'A' or 'B']`
    * ***Functions:***
        * `dayType($date)`
            * Returns 'ND' for a Normal Day (7:30 AM to 3:30 PM) and 'SD' for a Short Day (7:30 AM to 12:30 PM)
            * `dayType("")` returns the day type for the current day.
            * *Ex.*
                * 4/16/2020 → 'ND'
                * 4/17/2020 → 'SD'
        * `dayAB($date)`
            * Returns 'A' or 'B', the type of 
            * `dayAB("")` returns the type of day for the current day.
			* *Ex.*
				* 4/16/2020 → 'A'
				* 4/17/2020 → 'B'
        * `per($date, $time)`
            * Returns the period number corresponding with the given date and time.
            * `per("", "")` returns the current period (of the current timestamp).
            * Must take into account short days (use `dayType`) and if the day is an 'A' or 'B' day (use `dayAB`).
            * *Ex.
                * 4/16/2020 @ 7:53 AM → '1'
                * 4/16/2020 @ 9:17 AM → '3'
                * 4/16/2020 @ 9:17 AM → '2'
> For all functions, when an invalid input is given, `die` with a proper error message (Ex. `die("ERROR: Date given is not a school day!");`).
