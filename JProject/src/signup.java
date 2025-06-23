import java.awt.Component;
import java.awt.FlowLayout;
import java.awt.Font;
import java.awt.Frame;
import java.sql.PreparedStatement;
import java.sql.SQLException;

import javax.swing.JButton;
import javax.swing.JComboBox;
import javax.swing.JComponent;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.JPasswordField;
import javax.swing.JTextField;

class signup extends JFrame {
	public signup() {
		JLabel label1=new JLabel("SIGNUP FORM");
		JLabel label2=new JLabel("Name : ");
		JLabel label3=new JLabel("Email : ");
		JLabel label4=new JLabel("Role : ");
		JLabel label5=new JLabel("Username : ");
		JLabel label6=new JLabel("Password : ");
		JButton button1=new JButton("Signup");
		JButton button2=new JButton("Already signed up ? LOGIN HERE");
		JTextField field1=new JTextField();
		JTextField field2=new JTextField();
		String[] r= {"Admin", "User"};
		JComboBox<String> box=new JComboBox<String>(r);
		JTextField field4=new JTextField();
		JPasswordField field5=new JPasswordField();
		add(label1);
		add(label2);add(field1);
		add(label3);add(field2);
		add(label4);add(box);
		add(label5);add(field4);
		add(label6);add(field5);
		add(button1);add(button2);
		
		Component[] allComponents = {label2, label3, label4, label5, label6,
		                              field1, field2, field4, field5, box,
		                              button1, button2};
		setFontToAll(allComponents, new Font("", Font.BOLD, 15));
		
		label1.setFont(new Font("", Font.BOLD, 20));
        label1.setBounds(720, 30, 300, 30);

        // Labels and Fields (x, y, width, height)
        label2.setBounds(650, 80, 100, 25);
        field1.setBounds(760, 80, 200, 25);

        label3.setBounds(650, 120, 100, 25);
        field2.setBounds(760, 120, 200, 25);

        label4.setBounds(650, 160, 100, 25);
        box.setBounds(760, 160, 200, 25);

        label5.setBounds(650, 200, 100, 25);
        field4.setBounds(760, 200, 200, 25);

        label6.setBounds(650, 240, 100, 25);
        field5.setBounds(760, 240, 200, 25);

        button1.setBounds(760, 290, 100, 30);
        button2.setBounds(650, 340, 310, 30);
        
        button1.addActionListener(e ->{
        	String name = field1.getText().trim();
            String email = field2.getText().trim();
            String username = field4.getText().trim();
            String password = field5.getText().trim();
            String role = (String) box.getSelectedItem();
            if (name.isEmpty() || email.isEmpty() || username.isEmpty() || password.isEmpty()) {
                JOptionPane.showMessageDialog(this, "Please fill in all fields");
                return;
            }
            if (!email.matches("^[\\w.-]+@[\\w.-]+\\.\\w{2,}$")) {
                JOptionPane.showMessageDialog(this, "Invalid email format");
                return;
            }
            if (password.length() < 6) {
                JOptionPane.showMessageDialog(this, "Password should be at least 6 characters");
                return;
            }
            try {
				PreparedStatement ps=Conn.getConnection().prepareStatement("insert into signup (name, email,role,username,password) values (?,?,?,?,?);");
				ps.setString(1, name);
				ps.setString(2, email);
				ps.setString(3, role);
				ps.setString(4, username);
				ps.setString(5, password);
				ps.executeUpdate();
			} catch (SQLException e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			}
            
            JOptionPane.showMessageDialog(this, "Signup successful!");
            new login();
            dispose();
        });
        button2.addActionListener(e-> {new login();dispose();});
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
		new signup();
	}
}
