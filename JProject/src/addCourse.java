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

public class addCourse extends JFrame{
	public addCourse() {
		JLabel label1=new JLabel("ADD COURSE");
		JLabel label2=new JLabel("Course Name : ");
		JLabel label3=new JLabel("Course Mentor: ");
		JLabel label4=new JLabel("Registration Status : ");
		JLabel label5=new JLabel("Last date to register : ");
		JDateChooser chooser=new JDateChooser();
		chooser.setDateFormatString("yyyy-MM-dd");
		JLabel label6=new JLabel("Duration (month) : ");
		JButton button1=new JButton("Add");
		JButton button2=new JButton("Cancel");
		JTextField field2=new JTextField();
		JTextField field3=new JTextField();
		String[] r= {"Ongoing", "Closed"};
		JComboBox<String> box=new JComboBox<String>(r);
		chooser.addPropertyChangeListener("date", evt -> {
		    Date selected = chooser.getDate();
		    if (selected != null) {
		        Date today = new Date();
		        if (selected.before(today)) {
		            box.setSelectedItem("Closed");
		        } else {
		            box.setSelectedItem("Ongoing");
		        }
		    }
		});
		JTextField field6=new JTextField("");
		add(label1);
		add(label2);add(field2);
		add(label3);add(field3);
		add(label4);add(box);
		add(label5);add(chooser);
		add(label6);add(field6);
		add(button1);add(button2);
		box.setEnabled(false); 
		Component[] allComponents = {label2, label3, label4, label5, label6,
		                              field2, field3, field6, chooser, box,
		                              button1, button2};
		setFontToAll(allComponents, new Font("", Font.BOLD, 15));
		
		label1.setFont(new Font("", Font.BOLD, 20));
        label1.setBounds(720, 30, 300, 30);

        // Labels and Fields (x, y, width, height)
        label2.setBounds(610, 80, 200, 25);
        field2.setBounds(780, 80, 200, 25);

        label3.setBounds(610, 120, 200, 25);
        field3.setBounds(780, 120, 200, 25);

        label4.setBounds(610, 160, 200, 25);
        box.setBounds(780, 160, 200, 25);

        label5.setBounds(610, 200, 200, 25);
        chooser.setBounds(780, 200, 200, 25);

        label6.setBounds(610, 240, 200, 25);
        field6.setBounds(780, 240, 200, 25);

        button1.setBounds(720, 290, 200, 30);
        button2.setBounds(720, 340, 200, 30);
        
        button1.addActionListener(e ->{
        	String name = field2.getText().trim();
            String mentor = field3.getText().trim();
            String status = (String) box.getSelectedItem();
            Date udate = chooser.getDate();
            java.sql.Date ldate = new java.sql.Date(udate.getTime());
            String d = field6.getText();
            int duration=Integer.parseInt(d);
            if (name.isEmpty() || mentor.isEmpty() || d.isEmpty() || ldate==null) {
                JOptionPane.showMessageDialog(this, "Please fill in all fields");
                return;
            }
            try {
				PreparedStatement ps=Conn.getConnection().prepareStatement("insert into course (name, mentor,status,ldate,duration) values (?,?,?,?,?);");
				ps.setString(1, name);
				ps.setString(2, mentor);
				ps.setString(3, status);
				ps.setDate(4,ldate);
				ps.setInt(5, duration);
				ps.executeUpdate();
			} catch (SQLException e1) {
				
				e1.printStackTrace();
			}
            
            JOptionPane.showMessageDialog(this, "Added successful!");
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
		new addCourse();
		
	}
}
