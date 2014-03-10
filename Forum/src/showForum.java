
import java.io.BufferedReader;
import java.io.FileReader;
import java.io.IOException;
import java.util.ArrayList;
import java.util.Collection;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 * Servlet implementation class forumServlet
 */
@WebServlet("/showForum")
public class showForum extends HttpServlet
{
	private static final long serialVersionUID = 1L;

	/**
	 * @see HttpServlet#HttpServlet()
	 */
	public showForum()
	{
		super();
		// TODO Auto-generated constructor stub
	}

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse
	 *      response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response)
	      throws ServletException, IOException
	{
		if (request.getSession().getAttribute("LoggedUser") == null)
		{
			response.sendRedirect("index.jsp");
		}
		else
		{
			ArrayList<ForumPost> allPosts = getPosts();
			request.setAttribute("allPosts", allPosts);
			request.getRequestDispatcher("Forum.jsp").forward(request, response);
		}
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse
	 *      response)
	 */
	protected void doPost(HttpServletRequest request,
	      HttpServletResponse response) throws ServletException, IOException
	{
		// TODO Auto-generated method stub
	}

	public ArrayList<ForumPost> getPosts()
	{
		ArrayList<ForumPost> tmp = new ArrayList<ForumPost>();
		try
		{
			BufferedReader br = new BufferedReader(new FileReader(
			      getServletContext().getRealPath("forum.txt")));
			String buffer;
			String comment;
			User usr;

			while ((buffer = br.readLine()) != null)
			{
				comment = "";
				usr = null;

				if (buffer.indexOf(" ") > -1)
				{
					usr = new User(buffer.split(" ")[0], "");
					comment = buffer.substring(buffer.indexOf(" "));
					tmp.add(new ForumPost(usr, comment));
				}

			}

			br.close();
		} catch (IOException e)
		{
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		return tmp;
	}

}
