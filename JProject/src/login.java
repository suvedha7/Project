import java.awt.Component;
import java.awt.Font;
import java.awt.Frame;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

import javax.swing.JButton;
import javax.swing.JComboBox;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JPasswordField;
import javax.swing.JTextField;

public class login extends JFrame{
	public login() {
		JLabel label1=new JLabel("LOGIN FORM");
		JLabel label2=new JLabel("Username : ");
		JLabel label3=new JLabel("Password : ");
		JButton button1=new JButton("Login");
		JButton button2=new JButton("No signed up ? SIGNUP HERE");
		JTextField field2=new JTextField();
		JPasswordField field3=new JPasswordField();
		add(label1);
		add(label2);add(field2);
		add(label3);add(field3);
		add(button1);add(button2);
		
		Component[] allComponents = {label2, label3, field2, field3,
		                              button1, button2};
		setFontToAll(allComponents, new Font("", Font.BOLD, 15));
		
		label1.setFont(new Font("", Font.BOLD, 20));
        label1.setBounds(720, 30, 300, 30);

        // Labels and Fields (x, y, width, height)
        label2.setBounds(650, 80, 100, 25);
        field2.setBounds(760, 80, 200, 25);

        label3.setBounds(650, 120, 100, 25);
        field3.setBounds(760, 120, 200, 25);

        button1.setBounds(760,160, 100, 30);
        button2.setBounds(650, 210, 310, 30);
        
        button1.addActionListener(e ->{
            String username = field2.getText().trim();
            String password = field3.getText().trim();
            if ( username.isEmpty() || password.isEmpty()) {
                JOptionPane.showMessageDialog(this, "Please fill in all fields");
                return;
            }
            PreparedStatement ps;
			try {
				ps = Conn.getConnection().prepareStatement("select id,username,role from signup where username=? and password=?;");
				ps.setString(1, username);
	            ps.setString(2, password);
	            ResultSet rs= ps.executeQuery();
	            if(rs.next()) {
	            	int id=rs.getInt("id");
	            	String uname=rs.getString("username");
	            	String role=rs.getString("role");
	            	Session.setSession(id, uname, role);
	            	JOptionPane.showMessageDialog(null, "Login successful! Welcome " + Session.getUsername());
	            	new home();
	            	dispose();
	            }
			} catch (SQLException e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			}
            
            
        });
        button2.addActionListener(e-> {new signup(); dispose();});
		setLayout(null);
		setVisible(true);
		setExtendedState(Frame.MAXIMIZED_BOTH);
		
	}	
	void setFontToAll(Component[] components, Font font) {
	    for (Component c : components) {
	        c.setFont(font);
	    }
	}
	public static void main(String[] args) {
		new login();
	}
}
