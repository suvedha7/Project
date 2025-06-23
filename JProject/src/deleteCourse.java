import java.awt.Component;
import java.awt.Font;
import java.awt.Frame;
import java.sql.PreparedStatement;
import java.sql.SQLException;
import java.util.Date;

import javax.swing.JButton;
import javax.swing.JComboBox;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JPasswordField;
import javax.swing.JTextField;

import com.toedter.calendar.JDateChooser;

public class deleteCourse extends JFrame{
	public deleteCourse() {
		JLabel label0=new JLabel("DELETE COURSE");
		JLabel label1=new JLabel("Course ID : ");
		JButton button1=new JButton("Delete");
		JButton button2=new JButton("Cancel");
		JTextField field1=new JTextField();
		add(label0);
		add(label1);add(field1);
		add(button1);add(button2);
		Component[] allComponents = {label1,field1,button1, button2};
		setFontToAll(allComponents, new Font("", Font.BOLD, 15));
		
		label0.setFont(new Font("", Font.BOLD, 20));
        label0.setBounds(720, 30, 300, 30);

        // Labels and Fields (x, y, width, height)
        label1.setBounds(610, 80, 200, 25);
        field1.setBounds(780, 80, 200, 25);
        

        button1.setBounds(720, 330, 200, 30);
        button2.setBounds(720, 380, 200, 30);
        
        button1.addActionListener(e ->{
        	int id=Integer.parseInt(field1.getText());
        	
            try {
				PreparedStatement ps=Conn.getConnection().prepareStatement("delete from course where id=?;");
				ps.setInt(1, id);
				ps.executeUpdate();
			} catch (SQLException e1) {
				
				e1.printStackTrace();
			}
            
            JOptionPane.showMessageDialog(this, "Deleted successful!");
            new home();
            dispose();
        });
        button2.addActionListener(e-> {new home();dispose();});
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
		new deleteCourse();
		
	}
}
