import java.awt.BorderLayout;
import java.awt.CardLayout;
import java.awt.Component;
import java.awt.FlowLayout;
import java.awt.Font;
import java.awt.Frame;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.sql.Date;
import java.sql.ResultSet;
import java.sql.SQLException;

import javax.swing.BorderFactory;
import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JPanel;
import javax.swing.JScrollPane;
import javax.swing.JTable;
import javax.swing.table.DefaultTableModel;

public class showCourse extends JFrame {
	public showCourse() {
		JLabel label = new JLabel("All Courses");
		String[] columns= {"Id","Course Name", "Course Mentor", "Status","Last Date","Duration"};
		DefaultTableModel model=new DefaultTableModel(columns, 0);
		model.addRow(columns);
		JTable table=new JTable(model);
		table.setRowHeight(28);
		JButton button = new JButton("Show");
		JButton button2 = new JButton("Exit");
		label.setFont(new Font("", Font.BOLD, 20));
		Component[] allComponents = {label, button,table, button2};
		setFontToAll(allComponents, new Font("", Font.BOLD, 15));
		
		JPanel outerPanel = new JPanel(new BorderLayout(0, 40));
        outerPanel.setBorder(BorderFactory.createEmptyBorder(40, 40, 40, 40));
        add(outerPanel);
        JPanel topPanel = new JPanel(new FlowLayout());
        topPanel.add(label);
        outerPanel.add(topPanel, BorderLayout.NORTH);
        JPanel centerPanel = new JPanel(new BorderLayout());
        centerPanel.add(table, BorderLayout.CENTER);
        outerPanel.add(centerPanel, BorderLayout.CENTER);
        JPanel bottomPanel = new JPanel(new FlowLayout());
        bottomPanel.add(button);
        bottomPanel.add(button2);
        outerPanel.add(bottomPanel, BorderLayout.SOUTH);
        
        
		button.addActionListener(new ActionListener() {
			
			@Override
			public void actionPerformed(ActionEvent e) {
				String sql="select * from course;";
				model.setRowCount(1);
				try {
					ResultSet set=Conn.getConnection().createStatement().executeQuery(sql);
					while(set.next()) {
						int id=set.getInt("id");
						String name=set.getString("name");
						String mentor=set.getString("mentor");
						String status=set.getString("status");
						Date ldate=set.getDate("ldate");
						int duration=set.getInt("duration");
						Object[] row= {id,name,mentor,status,ldate,duration};
						model.addRow(row);
					}
					
				} catch (SQLException e1) {
					// TODO Auto-generated catch block
					e1.printStackTrace();
				}
				
			}
		});
		button2.addActionListener(new ActionListener() {
			
			@Override
			public void actionPerformed(ActionEvent e) {
				new home();
				dispose();
			}
		});
		setVisible(true);
		setExtendedState(Frame.MAXIMIZED_BOTH);
	}
	void setFontToAll(Component[] components, Font font) {
	    for (Component c : components) {
	        c.setFont(font);
	    }
	}
	public static void main(String[] args) {
		new showCourse();
	}
}
