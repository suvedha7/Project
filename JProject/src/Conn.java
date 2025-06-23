
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class Conn {
	static Connection getConnection() {
		try {
			Class.forName("com.mysql.cj.jdbc.Driver");
		} catch (ClassNotFoundException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		Connection c= null;
		try {
			c=DriverManager.getConnection("jdbc:mysql://localhost:3306/javaproject", "root", "");
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		return c;
		
	}
}
