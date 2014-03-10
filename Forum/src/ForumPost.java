public class ForumPost
{
	private User mUser;
	private String mComment;
	
	public ForumPost(User pUser, String pComment)
	{
		mUser = pUser;
		mComment = pComment;
	}
	
	public User getUser()
	{
		return mUser;
	}
	
	public void setUser(User pUser)
	{
		mUser = pUser;
	}
	
	public String getComment()
	{
		return mComment;
	}
	
	public void setComment(String pComment)
	{
		mComment = pComment;
	}
}
