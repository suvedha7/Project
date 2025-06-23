import java.awt.Component;
import java.awt.Dimension;
import java.awt.FlowLayout;
import java.awt.Font;
import java.awt.Frame;

import javax.swing.Box;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JMenu;
import javax.swing.JMenuBar;
import javax.swing.event.MenuEvent;
import javax.swing.event.MenuListener;

public class home extends JFrame{
	public home() {
		JLabel label1=new JLabel("Welcome "+Session.getUsername()+". You are "+Session.getRole());
		JMenuBar bar=new JMenuBar();
		JMenu menu1=new JMenu("Home");
		JMenu menu2=new JMenu("Add Course");
		JMenu menu3=new JMenu("Edit Course");
		JMenu menu4=new JMenu("Delete Course");
		JMenu menu5=new JMenu("All Course");
		JMenu menu6=new JMenu("Logout");
		Component[] allComponents = {menu1,menu2,menu3,menu4,menu5,menu6,label1};
		setFontToAll(allComponents, new Font("", Font.BOLD, 15));
		setJMenuBar(bar);
		bar.add(Box.createRigidArea(new Dimension(30, 0)));
		bar.add(menu1);
		String role = Session.getRole();
        if ("admin".equalsIgnoreCase(role)) {
            bar.add(menu2);
            bar.add(menu3);
            bar.add(menu4);
        }
		bar.add(menu5);
		bar.add(Box.createHorizontalGlue());
        bar.add(menu6);
        bar.add(Box.createRigidArea(new Dimension(30, 0)));
		add(label1);
		
		menu1.addMenuListener(new MenuListener() {
			
			@Override
			public void menuSelected(MenuEvent e) {
				new home();
				dispose();
			}
			
			@Override
			public void menuDeselected(MenuEvent e) {
				// TODO Auto-generated method stub
				
			}
			
			@Override
			public void menuCanceled(MenuEvent e) {
				// TODO Auto-generated method stub
				
			}
		});
		menu2.addMenuListener(new MenuListener() {
			
			@Override
			public void menuSelected(MenuEvent e) {
				new addCourse();
				dispose();
			}
			
			@Override
			public void menuDeselected(MenuEvent e) {
				// TODO Auto-generated method stub
				
			}
			
			@Override
			public void menuCanceled(MenuEvent e) {
				// TODO Auto-generated method stub
				
			}
		});
		menu3.addMenuListener(new MenuListener() {
			
			@Override
			public void menuSelected(MenuEvent e) {
				new editCourse();
				dispose();
			}
			
			@Override
			public void menuDeselected(MenuEvent e) {
				// TODO Auto-generated method stub
				
			}
			
			@Override
			public void menuCanceled(MenuEvent e) {
				// TODO Auto-generated method stub
				
			}
		});
		menu4.addMenuListener(new MenuListener() {
			
			@Override
			public void menuSelected(MenuEvent e) {
				new deleteCourse();
				dispose();
			}
			
			@Override
			public void menuDeselected(MenuEvent e) {
				// TODO Auto-generated method stub
				
			}
			
			@Override
			public void menuCanceled(MenuEvent e) {
				// TODO Auto-generated method stub
				
			}
		});
		menu5.addMenuListener(new MenuListener() {
			
			@Override
			public void menuSelected(MenuEvent e) {
				new showCourse();
				dispose();
			}
			
			@Override
			public void menuDeselected(MenuEvent e) {
				// TODO Auto-generated method stub
				
			}
			
			@Override
			public void menuCanceled(MenuEvent e) {
				// TODO Auto-generated method stub
				
			}
		});
		menu6.addMenuListener(new MenuListener() {
			
			@Override
			public void menuSelected(MenuEvent e) {
				Session.clearSession();
				new login();
				dispose();
			}
			
			@Override
			public void menuDeselected(MenuEvent e) {
				// TODO Auto-generated method stub
				
			}
			
			@Override
			public void menuCanceled(MenuEvent e) {
				// TODO Auto-generated method stub
				
			}
		});
		setLayout(new FlowLayout());
		setVisible(true);
		setExtendedState(Frame.MAXIMIZED_BOTH);
		
	}
	void setFontToAll(Component[] components, Font font) {
	    for (Component c : components) {
	        c.setFont(font);
	    }
	}
	public static void main(String[] args) {
		new home();
	}
}
