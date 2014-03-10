

import java.io.File;
import java.io.IOException;
import java.io.RandomAccessFile;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 * Servlet implementation class AddForumMessage
 */
@WebServlet("/AddForumMessage")
public class AddForumMessage extends HttpServlet {
	private static final long serialVersionUID = 1L;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public AddForumMessage() {
        super();
        // TODO Auto-generated constructor stub
    }

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		if (request.getSession().getAttribute("LoggedUser") == null)
		{
			response.sendRedirect("index.jsp");
		}
		else
		{
			response.sendRedirect("showForum.jsp");
		}
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		if (request.getSession().getAttribute("LoggedUser") == null)
		{
			response.sendRedirect("index.jsp");
		}
		else
		{
			String comment = request.getParameter("txtMessage");
			if (comment.equals(""))
			{
				response.sendRedirect("AddPost.jsp");
			}
			else
			{
				
				String user = ((User)request.getSession().getAttribute("LoggedUser")).getUsername();
				String line = user + " " + comment + "\n";
				
				RandomAccessFile f = new RandomAccessFile(new File(getServletContext().getRealPath("forum.txt")), "rw");
				byte[] text = new byte[(int) f.length()];
			    f.readFully(text);
			    f.seek(0);
			    f.writeBytes(line);
			    f.write(text);
			    f.close();
				response.sendRedirect("showForum");
			}
		}
	}

}
