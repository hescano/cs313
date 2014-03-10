

import java.io.BufferedReader;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.IOException;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import org.apache.catalina.connector.Request;

/**
 * Servlet implementation class DoLogin
 */
@WebServlet("/DoLogin")
public class DoLogin extends HttpServlet {
	private static final long serialVersionUID = 1L;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public DoLogin() {
        super();
        // TODO Auto-generated constructor stub
    }

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		response.sendRedirect("index.jsp");
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		String userName = request.getParameter("username");
		String password = request.getParameter("password");
		User tmp;
		if ((tmp = login(userName, password)) != null)
		{
			request.getSession().setAttribute("LoggedUser", tmp);
			response.sendRedirect("showForum");
		}
		else
		{
			request.getSession().setAttribute("validUser", false);
			response.sendRedirect("index.jsp");
		}
		
	}

	private User login(String userName, String password) {
		//request.setAttribute("scriptures", scriptures);
		//request.getRequestDIspatcher("scriptureList.jsp").forward(request, response);
		return getUserFromFile(userName, password);
	}
	
	
	private User getUserFromFile(String userName, String password)
	{
		User tmp = null;
		
		try
      {
	      BufferedReader br = new BufferedReader(new FileReader(getServletContext().getRealPath("users.txt")));
	      String buffer;
	      while ((buffer = br.readLine()) != null)
	      {
	      	if (buffer.split(" ")[0].equals(userName))
	      	{
	      		if (buffer.split(" ")[1].equals(password))
	      		{
	      			tmp = new User(userName, password);
	      			break;
	      		}
	      	}
	      }
	      
	      br.close();
      } 
		catch (IOException e)
      {
	      // TODO Auto-generated catch block
	      e.printStackTrace();
      }
		
		return tmp;
	}
}