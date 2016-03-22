<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>{title}</title>
    </head>
    <body>
            <div id="content">
                Please select one:
                <br></br>
                <form method="post" id="form" action="Welcome/about">
                    <select name="Courses">
                        <option></option>
                        <option value="4711">4711</option>
                        <option value="4932">4932</option>
                        <option value="4995">4995</option>
                        <option value="4735">4735</option>
                        <option value="4560">4560</option>
                        <option value="3600">3600</option>
                    </select>
                    <select name="Times">
                        <option></option>
                        <option value="8:30am">8:30am</option>
                        <option value="9:30am">9:30am</option>
                        <option value="10:30am">10:30am</option>
                        <option value="11:30am">11:30am</option>
                        <option value="12:30pm">12:30pm</option>
                        <option value="1:30pm">1:30pm</option>
                        <option value="2:30pm">2:30pm</option>
                        <option value="3:30pm">3:30pm</option>
                    </select>
                    <select name="Days">
                        <option></option>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                    </select>
                </form>
                <button type="submit" form="form">Select</button>
                <br></br>
                <div id="Name">
                    <Table border='1'>
                        {TableContent}
                    </Table>
                    
                </div>
            </div>
            <div id="footer" class="span12">
                Copyright &copy; 2015-2016,  John, Austin.
            </div>
    </body>
</html>

